<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ServiceCategoryController extends Controller
{
    public function ServiceCategoryList()
    {
        $title = 'Service Category List';

        $service_categories = ServiceCategory::latest()->get();

        return view('backend.service.service_category.list', compact('title', 'service_categories'));
    } // End Method

    public function ServiceCategoryAdd()
    {
        $title = 'Service Category Add';

        return view('backend.service.service_category.add', compact('title'));
    } // End Method

    public function ServiceCategoryStore(Request $request)
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
            $data = new ServiceCategory();
            $data->name = $request->name;
            $data->dropdown_width = null;
            $data->save();

            DB::commit();

            return redirect()->route('admin.service-category.list')->with('success', 'Service Category created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error occurred while creating service category: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!')->withInput();
        }
    } // End Method

    public function ServiceCategoryEdit($id)
    {
        $title = 'Service Category Edit';

        $service_category = ServiceCategory::findOrFail($id);

        return view('backend.service.service_category.edit', compact('title', 'service_category'));
    } // End Method

    public function ServiceCategoryUpdate(Request $request)
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
            $data = ServiceCategory::findOrFail($request->id);
            if (!$data) {
                abort(404);
            }
            $data->name = $request->name;
            $data->save();

            DB::commit();

            return redirect()->route('admin.service-category.list')->with('success', 'Service Category Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while updating service category: ' . $e->getMessage());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }
        }
    } // End Method

    public function ServiceCategoryDelete($id)
    {
        DB::beginTransaction();

        try {
            $category = ServiceCategory::findOrFail($id);
            $serviceDetails = $category->serviceDetails;

            foreach ($serviceDetails as $detail) {
                $service = Service::find($detail->service_id);

                if ($service) {
                    $imagePath = public_path($detail->service_image);
                    if (is_file($imagePath) && file_exists($imagePath)) {
                        unlink($imagePath);
                    }

                    $service->delete();
                }

                $detail->delete();
            }

            $category->delete();

            DB::commit();
            return redirect()->route('admin.service-category.list')->with('success', 'Service Category and related services deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error occurred while deleting service category: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Something went wrong!');
        }
    } // End Method
}
