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
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ServiceController extends Controller
{
    public function ServiceList()
    {
        $title = 'Service';

        $services = Service::orderBy('id', 'asc')->get();

        $categories = ServiceCategory::all();

        return view('backend.service.list', compact('title', 'services', 'categories'));
    } // End Method

    public function ServiceAdd()
    {
        $title = 'Service';
        $categories = ServiceCategory::all();

        return view('backend.service.add', compact('title', 'categories'));
    } // End Method

    public function ServiceStore(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|max:100',
                'service_image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'short_description' => 'required|string|max:250',
                'long_description' => 'required|string',
            ],
            [
                'title.required' => 'Title is required',
                'title.max' => 'Title is too long',
                'service_image.required' => 'Service image is required',
                'service_image.image' => 'Service image must be an image',
                'service_image.mimes' => 'Service image must be jpeg, png or jpg',
                'service_image.max' => 'Service image must be less than 2MB',
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
            $service->slug = Str::slug($request->slug);
            $service->category_id = 1;
            $service->date = now()->format('Y-m-d');
            $service->created_by = Auth::user()->id;
            $service->save();

            $serviceDetails = new ServiceDetails();
            $serviceDetails->service_id = $service->id;
            $serviceDetails->icon = '#!';
            $serviceDetails->short_description = $request->short_description;
            $serviceDetails->long_description = $request->long_description;
            $serviceDetails->meta_title = $request->meta_title;
            $serviceDetails->meta_description = $request->meta_description;
            $serviceDetails->meta_keyword = $request->meta_keyword;

            if ($request->hasFile('service_image')) {
                $service_image = $request->file('service_image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $service_image->getClientOriginalExtension();
                $image = $manager->read($service_image);
                $image->resize(850, 400);
                $image->toJpeg(80)->save(base_path('public/uploads/services/' . $name_gen));
                $serviceDetails->service_image = 'uploads/services/' . $name_gen;
            }

            $serviceDetails->save();

            DB::commit();

            return redirect()->route('admin.service.list')->with('success', 'Service created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('ServiceStore Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!')->withInput();
        }
    }

    public function ServiceEdit($id)
    {
        $title = 'Service';
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
                'service_image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'short_description' => 'required|string|max:250',
                'long_description' => 'required|string',
                'status' => 'required',
            ],
            [
                'id.required' => 'Service ID is required',
                'title.required' => 'Title is required',
                'title.max' => 'Title is too long',
                'service_image.image' => 'Service image must be an image',
                'service_image.mimes' => 'Service image must be jpeg, png or jpg',
                'service_image.max' => 'Service image must be less than 2MB',
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
            $service->title = $request->title;
            $service->slug = Str::slug($request->slug);
            $service->date = now()->format('Y-m-d');
            $service->status = $request->status;
            $service->category_id = 1;
            $service->updated_by = Auth::user()->id;
            $service->save();

            $serviceDetails = ServiceDetails::where('service_id', $service->id)->first();
            if (!$serviceDetails) {
                $serviceDetails = new ServiceDetails();
                $serviceDetails->service_id = $service->id;
            }

            $serviceDetails->icon = '#!';
            $serviceDetails->short_description = $request->short_description;
            $serviceDetails->long_description = $request->long_description;
            $serviceDetails->meta_title = $request->meta_title;
            $serviceDetails->meta_description = $request->meta_description;
            $serviceDetails->meta_keyword = $request->meta_keyword;

            if ($request->hasFile('service_image')) {
                // পুরনো image delete
                if ($serviceDetails->service_image && file_exists(base_path('public/' . $serviceDetails->service_image))) {
                    unlink(base_path('public/' . $serviceDetails->service_image));
                }

                $service_image = $request->file('service_image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $service_image->getClientOriginalExtension();
                $image = $manager->read($service_image);
                $image->resize(850, 400);
                $image->toJpeg(80)->save(base_path('public/uploads/services/' . $name_gen));
                $serviceDetails->service_image = 'uploads/services/' . $name_gen;
            }

            $serviceDetails->save();

            DB::commit();

            return redirect()->back()->with('success', 'Service updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('ServiceUpdate Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!')->withInput();
        }
    }

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
