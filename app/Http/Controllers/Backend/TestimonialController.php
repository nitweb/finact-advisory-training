<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class TestimonialController extends Controller
{
    public function TestimonialList()
    {
        $title = 'Testimonial List';
        $testimonials = Testimonial::orderBy('id', 'desc')->get();
        return view('backend.testimonial.list', compact('title', 'testimonials'));
    }

    public function TestimonialAdd()
    {
        $title = 'Add Testimonial';
        return view('backend.testimonial.add', compact('title'));
    }

    public function TestimonialStore(Request $request)
    {
        DB::beginTransaction();

        $validator = Validator::make(
            $request->all(),
            [
                'client_name'        => 'required|max:100',
                'client_designation' => 'required|max:100',
                'review_text'        => 'required',
                'rating'             => 'required|integer|min:1|max:5',
                'client_image'       => 'required|image|max:1024',
            ],
            [
                'client_name.required'        => 'Client name is required',
                'client_designation.required' => 'Designation is required',
                'review_text.required'        => 'Review text is required',
                'rating.required'             => 'Rating is required',
                'client_image.required'       => 'Client image is required',
                'client_image.image'          => 'File must be an image',
                'client_image.max'            => 'Image must be less than 1MB',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = new Testimonial();
            $data->client_name        = $request->client_name;
            $data->client_designation = $request->client_designation;
            $data->review_text        = $request->review_text;
            $data->rating             = $request->rating;
            $data->created_by         = Auth::user()->id;
            $data->updated_by         = null;

            if ($request->file('client_image')) {
                $image    = $request->file('client_image');
                $manager  = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $img      = $manager->read($image);
                $img->resize(150, 150);
                $img->toJpeg(80)->save(base_path('public/uploads/testimonial/' . $name_gen));
                $data->client_image = 'uploads/testimonial/' . $name_gen;
            }

            $data->save();
            DB::commit();

            return redirect()->route('admin.testimonial.list')->with('success', 'Testimonial Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Testimonial store error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    public function TestimonialEdit($id)
    {
        $title       = 'Edit Testimonial';
        $testimonial = Testimonial::findOrFail($id);
        return view('backend.testimonial.edit', compact('title', 'testimonial'));
    }

    public function TestimonialUpdate(Request $request)
    {
        DB::beginTransaction();

        $validator = Validator::make(
            $request->all(),
            [
                'id'                 => 'required|integer',
                'client_name'        => 'required|max:100',
                'client_designation' => 'required|max:100',
                'review_text'        => 'required',
                'rating'             => 'required|integer|min:1|max:5',
                'status'             => 'required',
                'client_image'       => 'nullable|image|max:1024',
            ],
            [
                'client_name.required'        => 'Client name is required',
                'client_designation.required' => 'Designation is required',
                'review_text.required'        => 'Review text is required',
                'rating.required'             => 'Rating is required',
                'status.required'             => 'Status is required',
                'client_image.image'          => 'File must be an image',
                'client_image.max'            => 'Image must be less than 1MB',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $data = Testimonial::findOrFail($request->id);

            $data->client_name        = $request->client_name;
            $data->client_designation = $request->client_designation;
            $data->review_text        = $request->review_text;
            $data->rating             = $request->rating;
            $data->status             = $request->status;
            $data->created_by         = null;
            $data->updated_by         = Auth::user()->id;

            if ($request->file('client_image')) {
                // Delete old image
                if ($data->client_image && file_exists(base_path('public/' . $data->client_image))) {
                    unlink(base_path('public/' . $data->client_image));
                }
                $image    = $request->file('client_image');
                $manager  = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $img      = $manager->read($image);
                $img->resize(150, 150);
                $img->toJpeg(80)->save(base_path('public/uploads/testimonial/' . $name_gen));
                $data->client_image = 'uploads/testimonial/' . $name_gen;
            }

            $data->save();
            DB::commit();

            return redirect()->route('admin.testimonial.list')->with('success', 'Testimonial Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Testimonial update error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    public function TestimonialDelete($id)
    {
        DB::beginTransaction();
        try {
            $data = Testimonial::findOrFail($id);
            if ($data->client_image && file_exists(base_path('public/' . $data->client_image))) {
                unlink(base_path('public/' . $data->client_image));
            }
            $data->delete();
            DB::commit();

            return redirect()->route('admin.testimonial.list')->with('success', 'Testimonial Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Testimonial delete error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }
}
