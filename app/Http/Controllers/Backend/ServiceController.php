<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ServiceController extends Controller
{
    public function ServiceList()
    {
        $title = 'Service List';

        $services = Service::orderBy('id', 'asc')->get();

        $categories = ServiceCategory::all();

        return view('backend.service.list', compact('title', 'services', 'categories'));
    } // End Method

    public function ServiceAdd()
    {
        $title = 'Service Add';
        $categories = ServiceCategory::all();

        return view('backend.service.add', compact('title', 'categories'));
    } // End Method

    public function ServiceStore(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|max:100',
                'category_id' => 'required|integer|exists:service_categories,id',
                'icon' => 'required|string|max:50',
                'service_image' => 'required|image|mimes:jpeg,png,jpg|max:1024',
                'short_description' => 'required|string|max:250',
                'long_description' => 'required|string',
            ],
            [
                'title.required' => 'Title is required',
                'title.max' => 'Title is too long',
                'category_id.required' => 'Service category is required',
                'category_id.integer' => 'Service category must be an integer',
                'category_id.exists' => 'Service category is not found',
                'icon.required' => 'Icon is required',
                'icon.max' => 'Icon is too long',
                'service_image.required' => 'Service image is required',
                'service_image.image' => 'Service image must be an image',
                'service_image.mimes' => 'Service image must be a file of type: jpeg, png, jpg, gif, svg',
                'service_image.max' => 'Service image must be less than 1MB',
                'short_description.required' => 'Short description is required',
                'short_description.max' => 'Short description is too long',
                'long_description.required' => 'Long description is required',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            $service = new Service();
            $service->title = $request->title;
            $service->slug = strtolower(str_replace(' ', '-', $request->slug));
            $service->category_id = $request->category_id;
            $service->date = now()->format('Y-m-d');
            $service->created_by = Auth::user()->id;
            $service->save();

            $serviceDetails = new ServiceDetails();
            $serviceDetails->service_id = $service->id;
            $serviceDetails->icon = $request->icon;
            $serviceDetails->short_description = $request->short_description;
            $serviceDetails->long_description = $request->long_description;
            $serviceDetails->meta_title = $request->meta_title;
            $serviceDetails->meta_description = $request->meta_description;
            $serviceDetails->meta_keyword = $request->meta_keyword;
            if ($request->file('service_image')) {
                $service_image = $request->file('service_image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $service_image->getClientOriginalExtension();
                $image = $manager->read($service_image);
                // $image->resize(1600, 500);
                $image->toJpeg(80)->save(base_path('public/uploads/services/' . $name_gen));
                $serviceDetails->service_image = 'uploads/services/' . $name_gen;
            }

            if ($request->file('service_banner_image')) {
                $service_banner_image = $request->file('service_banner_image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $service_banner_image->getClientOriginalExtension();
                $image = $manager->read($service_banner_image);
                // $image->resize(1600, 407);
                $image->toJpeg(80)->save(base_path('public/uploads/services/' . $name_gen));
                $serviceDetails->service_banner_image = 'uploads/services/' . $name_gen;
            }

            $serviceDetails->save();

            DB::commit();

            return redirect()->route('admin.service.list')->with('success', 'Service created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error occurred while creating service: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!')->withInput();
        }
    } // End Method

    public function ServiceEdit($id)
    {
        $title = 'Service Edit';
        $categories = ServiceCategory::all();
        $service = Service::findOrFail($id);
        $serviceDetails = $service->serviceDetail ?? null;
        return view('backend.service.edit', compact('title', 'categories', 'service', 'serviceDetails'));
    } // End Method

    public function ServiceUpdate(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required|integer',
                'title' => 'required|max:100',
                'category_id' => 'required|integer|exists:service_categories,id',
                'icon' => 'required|string|max:50',
                'service_image' => 'image|mimes:jpeg,png,jpg|max:1024',
                'short_description' => 'required|string|max:250',
                'long_description' => 'required|string',
                'status' => 'required',
            ],
            [
                'id.required' => 'Service ID is required',
                'title.required' => 'Title is required',
                'title.max' => 'Title is too long',
                'category_id.required' => 'Service category is required',
                'category_id.integer' => 'Service category must be an integer',
                'category_id.exists' => 'Service category is not found',
                'icon.required' => 'Icon is required',
                'icon.max' => 'Icon is too long',
                'service_image.image' => 'Service image must be an image',
                'service_image.mimes' => 'Service image must be a file of type: jpeg, png, jpg, gif, svg',
                'service_image.max' => 'Service image must be less than 1MB',
                'short_description.required' => 'Short description is required',
                'short_description.max' => 'Short description is too long',
                'long_description.required' => 'Long description is required',
                'status.required' => 'Status is required',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            $service = Service::findOrFail($request->id);
            if (!$service) {
                abort(404);
            }
            $service->title = $request->title;
            $service->slug = strtolower(str_replace(' ', '-', $request->slug));
            $service->date = now()->format('Y-m-d');
            $service->status = $request->status;
            $service->category_id = $request->category_id;
            $service->updated_by = Auth::user()->id;
            $service->save();

            $serviceDetails = ServiceDetails::where('service_id', $service->id)->first();
            if (!$serviceDetails) {
                $serviceDetails = new ServiceDetails();
                $serviceDetails->service_id = $service->id;
            }
            $serviceDetails->icon = $request->icon;
            $serviceDetails->short_description = $request->short_description;
            $serviceDetails->long_description = $request->long_description;
            $serviceDetails->meta_title = $request->meta_title;
            $serviceDetails->meta_description = $request->meta_description;
            $serviceDetails->meta_keyword = $request->meta_keyword;

            if ($request->file('service_image')) {
                if (file_exists(base_path('public/' . $serviceDetails->service_image))) {
                    unlink(base_path('public/' . $serviceDetails->service_image));
                }
                $service_image = $request->file('service_image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $service_image->getClientOriginalExtension();
                $image = $manager->read($service_image);
                // $image->resize(1600, 500);
                $image->toJpeg(80)->save(base_path('public/uploads/services/' . $name_gen));
                $serviceDetails->service_image = 'uploads/services/' . $name_gen;
            }

            if ($request->file('service_banner_image')) {
                if (file_exists(base_path('public/' . $serviceDetails->service_banner_image))) {
                    unlink(base_path('public/' . $serviceDetails->service_banner_image));
                }
                $service_banner_image = $request->file('service_banner_image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $service_banner_image->getClientOriginalExtension();
                $image = $manager->read($service_banner_image);
                $image->toJpeg(80)->save(base_path('public/uploads/services/' . $name_gen));
                $serviceDetails->service_banner_image = 'uploads/services/' . $name_gen;
            }

            $serviceDetails->save();

            DB::commit();

            return redirect()->route('admin.service.list')->with('success', 'Service updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error occurred while updating service: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!')->withInput();
        }
    } // End Method

    public function ServiceDelete($id)
    {
        DB::beginTransaction();

        try {
            $service = Service::findOrFail($id);
            $serviceDetails = ServiceDetails::where('service_id', $id)->first();

            if (!$service || !$serviceDetails) {
                abort(404);
            }

            $imagePath = public_path($serviceDetails->service_image);
            if (is_file($imagePath) && file_exists($imagePath)) {
                unlink($imagePath);
            }

            $bannerImagePath = public_path($serviceDetails->service_banner_image);
            if (is_file($bannerImagePath) && file_exists($bannerImagePath)) {
                unlink($bannerImagePath);
            }

            $service->delete();
            $serviceDetails->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Service deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error occurred while deleting service: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!')->withInput();
        }
    } // End Method
}
