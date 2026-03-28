<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use App\Models\ServiceSubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ServiceSubCategoryController extends Controller
{
    public function ServiceSubCategoryList()
    {
        $title = 'Service Sub-Category List';

        $service_sub_categories = ServiceSubCategory::latest()->get();

        return view('backend.service.service_sub_category.list', compact('title', 'service_sub_categories'));
    } // End Method

    public function ServiceSubCategoryAdd()
    {
        $title = 'Service Sub-Category Add';
        $categories = ServiceCategory::all();

        return view('backend.service.service_sub_category.add', compact('title', 'categories'));
    } // End Method

    public function ServiceSubCategoryStore(Request $request)
    {
        $request->validate(
            [
                'name' => 'required|max:100',
                'category_id' => 'required|integer|exists:service_categories,id',
            ],
            [
                'name.required' => 'Name is required',
                'name.max' => 'Name is too long',
                'category_id.required' => 'Category is required',
                'category_id.integer' => 'Category must be an integer',
                'category_id.exists' => 'Category is not found',
            ],
        );

        DB::beginTransaction();

        try {
            $data = new ServiceSubCategory();
            $data->name = $request->name;
            $data->category_id = $request->category_id;
            $data->save();

            DB::commit();

            return redirect()->route('admin.service-sub-category.list')->with('success', 'Service Sub-Category created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error occurred while creating service sub-category: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!')->withInput();
        }
    } // End Method

    public function ServiceSubCategoryEdit($id)
    {
        $title = 'Service Sub-Category Edit';
        $categories = ServiceCategory::all();
        $service_sub_category = ServiceSubCategory::findOrFail($id);

        return view('backend.service.service_sub_category.edit', compact('title', 'categories', 'service_sub_category'));
    } // End Method

    public function ServiceSubCategoryUpdate(Request $request)
    {
        DB::beginTransaction();

        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required|integer',
                'name' => 'required|max:100',
                'category_id' => 'required|integer|exists:service_categories,id',
            ],
            [
                'id.required' => 'ID is required',
                'name.required' => 'Name is required',
                'name.max' => 'Name is too long',
                'category_id.required' => 'Category is required',
                'category_id.integer' => 'Category must be an integer',
                'category_id.exists' => 'Category is not found',
            ],
        );

        try {
            $data = ServiceSubCategory::findOrFail($request->id);
            if (!$data) {
                abort(404);
            }
            $data->name = $request->name;
            $data->category_id = $request->category_id;
            $data->save();

            DB::commit();

            return redirect()->route('admin.service-sub-category.list')->with('success', 'Service Sub-Category Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while updating service sub-category: ' . $e->getMessage());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }
        }
    } // End Method

    public function ServiceSubCategoryDelete($id)
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
