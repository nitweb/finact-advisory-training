<?php

namespace App\Http\Controllers\Backend\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\BlogDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class BlogCategoryController extends Controller
{
    public function BlogCategoryList()
    {
        $blogDetails = BlogDetails::get();
        foreach ($blogDetails as $blogDetail) {
            $blog = Blog::findOrFail($blogDetail->blog_id);
            $blog->blog_category_id = $blogDetail->blog_category_id;
            $blog->save();
        }
        $title = 'Blog Category List';

        $blog_categories = BlogCategory::latest()->get();

        return view('backend.blog.blog_category.list', compact('title', 'blog_categories'));
    } // End Method

    public function BlogCategoryAdd()
    {
        $title = 'Blog Category Add';

        return view('backend.blog.blog_category.add', compact('title'));
    } // End Method

    public function BlogCategoryStore(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:100',
            ],
            [
                'name.required' => 'Name is required',
                'name.max' => 'Name is too long',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            $data = new BlogCategory();
            $data->name = $request->name;
            $data->save();

            DB::commit();

            return redirect()->route('admin.blog-category.list')->with('success', 'Blog Category created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error occurred while creating blog category: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!')->withInput();
        }
    } // End Method

    public function BlogCategoryEdit($id)
    {
        $title = 'Blog Category Edit';

        $blog_category = BlogCategory::findOrFail($id);

        return view('backend.blog.blog_category.edit', compact('title', 'blog_category'));
    } // End Method

    public function BlogCategoryUpdate(Request $request)
    {
        DB::beginTransaction();

        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required|integer',
                'name' => 'required|max:100',
            ],
            [
                'id.required' => 'ID is required',
                'name.required' => 'Name is required',
                'name.max' => 'Name is too long',
            ],
        );

        try {
            $data = BlogCategory::findOrFail($request->id);
            if (!$data) {
                abort(404);
            }
            $data->name = $request->name;
            $data->save();

            DB::commit();

            return redirect()->route('admin.blog-category.list')->with('success', 'Blog Category Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while updating blog category: ' . $e->getMessage());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }
        }
    } // End Method

    public function BlogCategoryDelete($id)
    {
        DB::beginTransaction();

        try {
            $category = BlogCategory::findOrFail($id);

            // Find all related blog details
            $blogDetails = $category->blogDetails;

            foreach ($blogDetails as $detail) {
                $blog = Blog::find($detail->blog_id); // Find the associated blog

                // If the blog exists, delete it and its image if present
                if ($blog) {
                    // Check if the blog image exists and is a file, then delete it
                    $imagePath = public_path($detail->blog_image);
                    if (is_file($imagePath) && file_exists($imagePath)) {
                        unlink($imagePath); // Delete the image file
                    }

                    // Delete the blog and its details
                    $blog->delete();
                }

                $detail->delete(); // Delete the blog detail
            }

            // After deleting all related blogs and their details, delete the category
            $category->delete();

            DB::commit();
            return redirect()->route('admin.blog-category.list')->with('success', 'Blog Category and related blogs deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error occurred while deleting blog category: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Something went wrong!');
        }
    } // End Method
}
