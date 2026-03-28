<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SliderController extends Controller
{
    public function SliderList()
    {
        $title = 'Slider List';

        $sliders = Slider::orderBy('id', 'asc')->get();

        return view('backend.slider.list', compact('title', 'sliders'));
    } // End Method

    public function SliderAdd()
    {
        $title = 'Slider Add';

        return view('backend.slider.add', compact('title'));
    } // End Method

    public function SliderStore(Request $request)
    {
        DB::beginTransaction();

        $validator = Validator::make(
            $request->all(),
            [
                // 'title' => 'required|max:100',
                // 'link' => 'required|max:100',
                // 'status' => 'required',
                'slider_image' => 'required|image|max:1024',
            ],
            [
                // 'title.required' => 'Title is required',
                // 'title.max' => 'Title is too long',
                // 'link.required' => 'Link is required',
                // 'link.max' => 'Link is too long',
                // 'status.required' => 'Status is required',
                'slider_image.required' => 'Slider Image is required',
                'slider_image.image' => 'Slider Image must be an image',
                'slider_image.max' => 'Slider Image must be less than 1MB',
            ],
        );

        try {
            $data = new Slider();
            $data->title = $request->title;
            $data->short_description = $request->short_description;
            $data->link = $request->link;
            $data->created_by = Auth::user()->id;
            $data->updated_by = null;

            if ($request->file('slider_image')) {
                $slider_image = $request->file('slider_image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $slider_image->getClientOriginalExtension();
                $image = $manager->read($slider_image);
                $image->resize(1600, 700);
                $image->toJpeg(80)->save(base_path('public/uploads/sliders/' . $name_gen));
                $data->slider_image = 'uploads/sliders/' . $name_gen;
            }

            $data->save();

            DB::commit();

            return redirect()->route('admin.slider.list')->with('success', 'Slider Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while creating slider: ' . $e->getMessage());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }
        }
    } // End Method

    public function SliderEdit($id)
    {
        $title = 'Slider Edit';

        $slider = Slider::findOrFail($id);

        return view('backend.slider.edit', compact('title', 'slider'));
    } // End Method

    public function SliderUpdate(Request $request)
    {
        DB::beginTransaction();

        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required|integer',
                // 'title' => 'required|max:100',
                // 'link' => 'required|max:100',
                'status' => 'required',
                'slider_image' => 'image|max:1024',
            ],
            [
                'id.required' => 'Slider ID is required',
                // 'title.max' => 'Title is too long',
                // 'link.required' => 'Link is required',
                // 'link.max' => 'Link is too long',
                'status.required' => 'Status is required',
                'slider_image.image' => 'Slider Image must be an image',
                'slider_image.max' => 'Slider Image must be less than 1MB',
            ],
        );

        try {
            $data = Slider::findOrFail($request->id);
            if (!$data) {
                abort(404);
            }
            $data->title = $request->title;
            $data->short_description = $request->short_description;
            $data->link = $request->link;
            $data->status = $request->status;
            $data->created_by = null;
            $data->updated_by = Auth::user()->id;

            if ($request->file('slider_image')) {
                if (file_exists(base_path('public/' . $data->slider_image))) {
                    unlink(base_path('public/' . $data->slider_image));
                }
                $slider_image = $request->file('slider_image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $slider_image->getClientOriginalExtension();
                $image = $manager->read($slider_image);
                $image->resize(1600, 700);
                $image->toJpeg(80)->save(base_path('public/uploads/sliders/' . $name_gen));
                $data->slider_image = 'uploads/sliders/' . $name_gen;
            }

            $data->save();

            DB::commit();

            return redirect()->route('admin.slider.list')->with('success', 'Slider Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while updating slider: ' . $e->getMessage());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }
        }
    } // End Method

    public function SliderDelete($id)
    {
        DB::beginTransaction();

        try {
            $slider = Slider::find($id);
            if (file_exists(base_path('public/' . $slider->slider_image))) {
                unlink(base_path('public/' . $slider->slider_image));
            }
            $slider->delete();

            DB::commit();

            return redirect()->route('admin.slider.list')->with('success', 'Slider Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while deleting slider: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    } // End Method
}
