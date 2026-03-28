<?php

namespace App\Http\Controllers\Backend\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BlogController extends Controller
{
    public function BlogList()
    {
        $title = 'Blog List';

        $blogs = Blog::latest()->get();

        return view('backend.blog.list', compact('title', 'blogs'));
    } // End Method

    public function BlogAdd()
    {
        $title = 'Blog Add';
        $categories = BlogCategory::all();

        return view('backend.blog.add', compact('title', 'categories'));
    } // End Method

    public function BlogStore(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|max:100',
                'blog_category_id' => 'required|integer|exists:blog_categories,id',
                'blog_image' => 'required|image|mimes:jpeg,png,jpg|max:1024',
                'short_description' => 'required|string|max:150',
                'long_description' => 'required|string',
            ],
            [
                'title.required' => 'Title is required',
                'title.max' => 'Title is too long',
                'blog_category_id.required' => 'Blog category is required',
                'blog_category_id.integer' => 'Blog category must be an integer',
                'blog_category_id.exists' => 'Blog category is not found',
                'blog_image.required' => 'Blog image is required',
                'blog_image.image' => 'Blog image must be an image',
                'blog_image.mimes' => 'Blog image must be a file of type: jpeg, png, jpg, gif, svg',
                'blog_image.max' => 'Blog image must be less than 1MB',
                'short_description.required' => 'Short description is required',
                'short_description.max' => 'Short description must be less than 150 characters',
                'long_description.required' => 'Long description is required',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            $blog = new Blog();
            $blog->title = $request->title;
            $blog->slug = strtolower(str_replace(' ', '-', $request->title));
            $blog->date = now()->format('Y-m-d');
            $blog->created_by = Auth::user()->id;
            $blog->save();

            $blogDetails = new BlogDetails();
            $blogDetails->blog_id = $blog->id;
            $blogDetails->blog_category_id = $request->blog_category_id;
            $blogDetails->short_description = $request->short_description;
            $blogDetails->long_description = $request->long_description;
            $blogDetails->meta_title = $request->meta_title;
            $blogDetails->meta_description = $request->meta_description;
            $blogDetails->meta_keyword = $request->meta_keyword;

            if ($request->file('blog_image')) {
                $blog_image = $request->file('blog_image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $blog_image->getClientOriginalExtension();
                $image = $manager->read($blog_image);
                // $image->resize(1600, 500);
                $image->toJpeg(80)->save(base_path('public/uploads/blog/' . $name_gen));
                $blogDetails->blog_image = 'uploads/blog/' . $name_gen;
            }

            $blogDetails->save();

            DB::commit();

            return redirect()->route('admin.blog.list')->with('success', 'Blog created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error occurred while creating blog: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!')->withInput();
        }
    } // End Method

    public function BlogEdit($id)
    {
        $title = 'Blog Edit';
        $categories = BlogCategory::all();
        $blog = Blog::findOrFail($id);
        $blogDetails = $blog->blogDetail ?? new BlogDetails();

        return view('backend.blog.edit', compact('title', 'categories', 'blog', 'blogDetails'));
    } // End Method

    public function BlogUpdate(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required|integer',
                'title' => 'required|max:100',
                'blog_category_id' => 'required|integer|exists:blog_categories,id',
                'blog_image' => 'image|mimes:jpeg,png,jpg|max:1024',
                'short_description' => 'required|string|max:150',
                'long_description' => 'required|string',
                'status' => 'required',
            ],
            [
                'id.required' => 'Service ID is required',
                'title.required' => 'Title is required',
                'title.max' => 'Title is too long',
                'blog_category_id.required' => 'Blog category is required',
                'blog_category_id.integer' => 'Blog category must be an integer',
                'blog_category_id.exists' => 'Blog category is not found',
                'blog_image.image' => 'Blog image must be an image',
                'blog_image.mimes' => 'Blog image must be a file of type: jpeg, png, jpg, gif, svg',
                'blog_image.max' => 'Blog image must be less than 1MB',
                'short_description.required' => 'Short description is required',
                'short_description.max' => 'Short description must be less than 150 characters',
                'long_description.required' => 'Long description is required',
                'status.required' => 'Status is required',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            $blog = Blog::findOrFail($request->id);
            if (!$blog) {
                abort(404);
            }
            $blog->title = $request->title;
            $blog->slug = strtolower(str_replace(' ', '-', $request->title));
            $blog->date = now()->format('Y-m-d');
            $blog->status = $request->status;
            $blog->updated_by = Auth::user()->id;
            $blog->save();

            $blogDetails = BlogDetails::where('blog_id', $blog->id)->first();
            if (!$blogDetails) {
                $blogDetails = new BlogDetails();
                $blogDetails->blog_id = $blog->id;
            }
            $blogDetails->blog_category_id = $request->blog_category_id;
            $blogDetails->short_description = $request->short_description;
            $blogDetails->long_description = $request->long_description;
            $blogDetails->meta_title = $request->meta_title;
            $blogDetails->meta_description = $request->meta_description;
            $blogDetails->meta_keyword = $request->meta_keyword;

            if ($request->file('blog_image')) {
                if (file_exists(base_path('public/' . $blogDetails->blog_image))) {
                    unlink(base_path('public/' . $blogDetails->blog_image));
                }
                $blog_image = $request->file('blog_image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $blog_image->getClientOriginalExtension();
                $image = $manager->read($blog_image);
                // $image->resize(1600, 500);
                $image->toJpeg(80)->save(base_path('public/uploads/blog/' . $name_gen));
                $blogDetails->blog_image = 'uploads/blog/' . $name_gen;
            }

            $blogDetails->save();

            DB::commit();

            return redirect()->route('admin.blog.list')->with('success', 'Blog updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error occurred while updating blog: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!')->withInput();
        }
    } // End Method

    public function BlogDelete($id)
    {
        DB::beginTransaction();

        try {
            $blog = Blog::findOrFail($id);
            $blogDetails = BlogDetails::where('blog_id', $id)->first();

            if (!$blog || !$blogDetails) {
                abort(404);
            }

            $imagePath = public_path($blogDetails->blog_image);
            if (is_file($imagePath) && file_exists($imagePath)) {
                unlink($imagePath); 
            }

            $blog->delete();
            $blogDetails->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Blog deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error occurred while deleting blog: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!')->withInput();
        }
    } // End Method
}
