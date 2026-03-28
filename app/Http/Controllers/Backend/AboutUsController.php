<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AboutUsController extends Controller
{
    public function AboutUsList()
    {
        $title = 'About Our Firm';

        $about_us = AboutUs::where('id', 1)->latest()->take(1)->get();

        return view('backend.about_us.list', compact('title', 'about_us'));
    } // End Method

    public function AboutUsEdit($id)
    {
        $title = 'About Our Firm Edit';

        $about_us = AboutUs::where('id', 1)->take(1)->get()->first();

        return view('backend.about_us.edit', compact('title', 'about_us'));
    } // End Method

    public function AboutUsUpdate(Request $request)
    {
        DB::beginTransaction();

        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required|integer',
                'description' => 'required',
                'about_us_image' => 'image|max:1024',
            ],
            [
                'id.required' => 'ID is required',
                'description.required' => 'Description is required',
                'about_us_image.image' => 'Image must be an image',
                'about_us_image.max' => 'Image must be less than 1MB',
            ],
        );

        try {
            $data = AboutUs::where('id', 1)->take(1)->first();
            if (!$data) {
                abort(404);
            }
            $data->description = $request->description;
            $data->updated_by = Auth::user()->id;

            if ($request->file('about_us_image')) {
                if (file_exists(base_path('public/' . $data->about_us_image))) {
                    unlink(base_path('public/' . $data->about_us_image));
                }
                $about_us_image = $request->file('about_us_image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $about_us_image->getClientOriginalExtension();
                $image = $manager->read($about_us_image);
                // $image->resize(464, 500);
                $image->toJpeg(80)->save(base_path('public/uploads/about_us/' . $name_gen));
                $data->about_us_image = 'uploads/about_us/' . $name_gen;
            }

            $data->save();

            DB::commit();

            return redirect()->route('admin.about-us.list')->with('success', 'About Us Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while updating about us: ' . $e->getMessage());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }
        }
    } // End Method

    public function AboutMessageList()
    {
        $title = 'Managing Partner Message';

        $about_message = AboutUs::where('id', '=', 2)->latest()->take(1)->get();

        return view('backend.about_message.list', compact('title', 'about_message'));
    } // End Method

    public function AboutMessageEdit($id)
    {
        $title = 'Managing Partner Message Edit';

        $about_message = AboutUs::where('id', '=', 2)->take(1)->get()->first();

        return view('backend.about_message.edit', compact('title', 'about_message'));
    } // End Method

    public function AboutMessageUpdate(Request $request)
    {
        DB::beginTransaction();

        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required|integer',
                'short_description' => 'required',
                'description' => 'required',
                'about_us_image' => 'image|max:1024',
            ],
            [
                'id.required' => 'ID is required',
                'short_description.required' => 'Short Description is required',
                'description.required' => 'Description is required',
                'about_us_image.image' => 'Image must be an image',
                'about_us_image.max' => 'Image must be less than 1MB',
            ],
        );

        try {
            $data = AboutUs::where('id', '=', 2)->take(1)->first();
            if (!$data) {
                abort(404);
            }
            $data->short_description = $request->short_description;
            $data->description = $request->description;
            $data->updated_by = Auth::user()->id;

            if ($request->file('about_us_image')) {
                if (file_exists(base_path('public/' . $data->about_us_image))) {
                    unlink(base_path('public/' . $data->about_us_image));
                }
                $about_us_image = $request->file('about_us_image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $about_us_image->getClientOriginalExtension();
                $image = $manager->read($about_us_image);
                // $image->resize(464, 500);
                $image->toJpeg(80)->save(base_path('public/uploads/about_us/' . $name_gen));
                $data->about_us_image = 'uploads/about_us/' . $name_gen;
            }

            $data->save();

            DB::commit();

            return redirect()->route('admin.about-message.list')->with('success', 'Managing Partner Message Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while updating Managing Partner Message: ' . $e->getMessage());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }
        }
    } // End Method
}
