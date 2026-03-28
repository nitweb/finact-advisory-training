<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Career;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CareerController extends Controller
{
    public function CareerList()
    {
        $title = 'Job Post List';

        $careers = Career::latest()->get();

        return view('backend.career.list', compact('title', 'careers'));
    } // End Method

    public function CareerAdd()
    {
        $title = 'Job Post Add';
        $career = Career::all();

        return view('backend.career.add', compact('title', 'career'));
    } // End Method

    public function CareerStore(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|max:100',
                'career_image' => 'required|image|mimes:jpeg,png,jpg|max:1024',
                'description' => 'required|string',
            ],
            [
                'title.required' => 'Title is required',
                'title.max' => 'Title is too long',
                'career_image.required' => 'Image is required',
                'career_image.image' => 'Image must be an image',
                'career_image.mimes' => 'Image must be a file of type: jpeg, png, jpg, gif, svg',
                'career_image.max' => 'Image must be less than 1MB',
                'description.required' => 'Long description is required',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            $data = new Career();
            $data->title = $request->title;
            $data->slug = strtolower(str_replace(' ', '-', $request->title));
            $data->description = $request->description;
            $data->meta_title = $request->meta_title;
            $data->meta_description = $request->meta_description;
            $data->meta_keyword = $request->meta_keyword;

            if ($request->file('career_image')) {
                $career_image = $request->file('career_image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $career_image->getClientOriginalExtension();
                $image = $manager->read($career_image);
                // $image->resize(400, 300);
                $image->toJpeg(80)->save(base_path('public/uploads/careers/' . $name_gen));
                $data->career_image = 'uploads/careers/' . $name_gen;
            }

            $data->save();

            DB::commit();

            return redirect()->route('admin.career.list')->with('success', 'Job Post created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error occurred while job post: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!')->withInput();
        }
    } // End Method

    public function CareerEdit($id)
    {
        $title = 'Job Post Edit';
        $career = Career::findOrFail($id);

        return view('backend.career.edit', compact('title', 'career'));
    } // End Method

    public function CareerUpdate(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required|integer',
                'title' => 'required|max:100',
                'description' => 'required|string',
                'status' => 'required',
            ],
            [
                'id.required' => 'ID is required',
                'title.required' => 'Title is required',
                'title.max' => 'Title is too long',
                'description.required' => 'Long description is required',
                'status.required' => 'Status is required',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            $data = Career::findOrFail($request->id);
            if (!$data) {
                abort(404);
            }
            $data->title = $request->title;
            $data->slug = strtolower(str_replace(' ', '-', $request->title));
            $data->description = $request->description;
            $data->status = $request->status;
            $data->meta_title = $request->meta_title;
            $data->meta_description = $request->meta_description;
            $data->meta_keyword = $request->meta_keyword;

            if ($request->file('career_image')) {
                if (file_exists(base_path('public/' . $data->career_image))) {
                    unlink(base_path('public/' . $data->career_image));
                }
                $career_image = $request->file('career_image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $career_image->getClientOriginalExtension();
                $image = $manager->read($career_image);
                // $image->resize(400, 300);
                $image->toJpeg(80)->save(base_path('public/uploads/careers/' . $name_gen));
                $data->career_image = 'uploads/careers/' . $name_gen;
            }

            $data->save();

            DB::commit();

            return redirect()->route('admin.career.list')->with('success', 'Job Post updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error occurred while updating job post: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!')->withInput();
        }
    } // End Method

    public function CareerDelete($id)
    {
        DB::beginTransaction();

        try {
            $career = Career::find($id);
            if (file_exists(base_path('public/' . $career->career_image))) {
                unlink(base_path('public/' . $career->career_image));
            }
            $career->delete();

            DB::commit();

            return redirect()->route('admin.career.list')->with('success', 'Job Post Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while deleting job post: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    } // End Method
}
