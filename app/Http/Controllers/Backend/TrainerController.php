<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class TrainerController extends Controller
{
    public function TrainerList()
    {
        $title = 'Trainer';

        $trainer_list = Trainer::orderBy('id', 'asc')->get();

        return view('backend.trainer.list', compact('title', 'trainer_list'));
    } // End Method

    public function TrainerAdd()
    {
        $title = 'Trainer';

        return view('backend.trainer.add', compact('title'));
    } // End Method

    public function TrainerStore(Request $request)
    {
        DB::beginTransaction();

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:255',
                'slug' => 'required|max:255',
                'designation' => 'required|max:255',
                'no_of_experience' => 'required|string',
                'description' => 'required|string',
                'trainer_image' => 'required|image|max:1024',
            ],
            [
                'name.required' => 'Name is required',
                'name.max' => 'Name is too long',
                'slug.required' => 'Slug is required',
                'slug.max' => 'Slug is too long',
                'designation.required' => 'Designation is required',
                'no_of_experience.required' => 'Number of Experience is required',
                'description.required' => 'Description is required',
                'trainer_image.required' => 'Trainer Image is required',
                'trainer_image.image' => 'Trainer Image must be an image',
                'trainer_image.max' => 'Trainer Image must be less than 1MB',
            ],
        );

        try {
            $data = new Trainer();

            $data->name = $request->name;
            $data->slug = Str::slug($request->slug);
            $data->designation = $request->designation;
            $data->no_of_experience = $request->no_of_experience;
            $data->description = $request->description;

            $data->meta_title = $request->meta_title;
            $data->meta_description = $request->meta_description;
            $data->meta_keyword = $request->meta_keyword;

            if ($request->file('trainer_image')) {
                $trainer_image = $request->file('trainer_image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $trainer_image->getClientOriginalExtension();
                $image = $manager->read($trainer_image);
                $image->resize(295, 325);
                $image->toJpeg(80)->save(base_path('public/uploads/trainer/' . $name_gen));
                $data->trainer_image = 'uploads/trainer/' . $name_gen;
            }

            $data->save();

            DB::commit();

            return redirect()->route('admin.trainer.list')->with('success', 'Trainer Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while creating trainer: ' . $e->getMessage());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }
        }
    } // End Method

    public function TrainerEdit($id)
    {
        $title = 'Trainer';

        $trainer_info = Trainer::findOrFail($id);

        return view('backend.trainer.edit', compact('title', 'trainer_info'));
    } // End Method

    public function TrainerUpdate(Request $request)
    {
        DB::beginTransaction();

        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required|integer',
                'name' => 'required|max:255',
                'slug' => 'required|max:255',
                'designation' => 'required|max:255',
                'no_of_experience' => 'required|string',
                'description' => 'required|string',
                'trainer_image' => 'image|max:1024',
            ],
            [
                'id.required' => 'ID is required',
                'name.required' => 'Name is required',
                'name.max' => 'Name is too long',
                'slug.required' => 'Slug is required',
                'slug.max' => 'Slug is too long',
                'designation.required' => 'Designation is required',
                'no_of_experience.required' => 'Number of Experience is required',
                'description.required' => 'Description is required',
                'trainer_image.image' => 'Trainer Image must be an image',
                'trainer_image.max' => 'Trainer Image must be less than 1MB',
            ],
        );

        try {
            $data = Trainer::findOrFail($request->id);

            if (!$data) {
                abort(404);
            }

            $data->name = $request->name;
            $data->slug = Str::slug($request->slug);
            $data->designation = $request->designation;
            $data->no_of_experience = $request->no_of_experience;
            $data->description = $request->description;

            $data->meta_title = $request->meta_title;
            $data->meta_description = $request->meta_description;
            $data->meta_keyword = $request->meta_keyword;

            if ($request->file('trainer_image')) {
                if (file_exists(base_path('public/' . $data->trainer_image))) {
                    unlink(base_path('public/' . $data->trainer_image));
                }
                $trainer_image = $request->file('trainer_image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $trainer_image->getClientOriginalExtension();
                $image = $manager->read($trainer_image);
                $image->resize(295, 325);
                $image->toJpeg(80)->save(base_path('public/uploads/trainer/' . $name_gen));
                $data->trainer_image = 'uploads/trainer/' . $name_gen;
            }

            $data->save();

            DB::commit();

            return redirect()->back()->with('success', 'Trainer Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while updating trainer: ' . $e->getMessage());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }
        }
    } // End Method

    public function TrainerDelete($id)
    {
        DB::beginTransaction();

        try {
            $trainer_info = Trainer::find($id);

            if (file_exists(base_path('public/' . $trainer_info->trainer_image))) {
                unlink(base_path('public/' . $trainer_info->trainer_image));
            }

            $trainer_info->delete();

            DB::commit();

            return redirect()->route('admin.trainer.list')->with('success', 'Trainer Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while deleting trainer: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    } // End Method
}
