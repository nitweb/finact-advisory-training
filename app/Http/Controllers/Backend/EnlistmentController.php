<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Enlistment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class EnlistmentController extends Controller
{
    public function EnlistmentList()
    {
        $title = 'Important Enlistment';

        $enlistment = Enlistment::latest()->get();

        return view('backend.enlistment.list', compact('title', 'enlistment'));
    } // End Method

    public function EnlistmentEdit($id)
    {
        $title = 'Important Enlistment Edit';

        $enlistment = Enlistment::get()->first();

        return view('backend.enlistment.edit', compact('title', 'enlistment'));
    } // End Method

    public function EnlistmentUpdate(Request $request)
    {
        DB::beginTransaction();

        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required|integer',
                'description' => 'required',
            ],
            [
                'id.required' => 'ID is required',
                'description.required' => 'Description is required',
            ],
        );

        try {
            $data = Enlistment::find($request->id);
            if (!$data) {
                abort(404);
            }
            $data->description = $request->description;

            if ($request->file('image')) {
                if (file_exists(base_path('public/' . $data->image))) {
                    unlink(base_path('public/' . $data->image));
                }
                $image = $request->file('image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $image = $manager->read($image);
                // $image->resize(464, 500);
                $image->toJpeg(80)->save(base_path('public/uploads/enlistment/' . $name_gen));
                $data->image = 'uploads/enlistment/' . $name_gen;
            }

            $data->save();

            DB::commit();

            return redirect()->route('admin.enlistment.list')->with('success', 'Important Enlistment Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while updating important enlistment: ' . $e->getMessage());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }
        }
    } // End Method
}
