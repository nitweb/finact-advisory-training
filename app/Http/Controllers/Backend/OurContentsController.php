<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\OurContents;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class OurContentsController extends Controller
{
    public function OurContentList()
    {
        $title = 'Our Contents List';

        $our_contents = OurContents::orderBy('id', 'desc')->get();

        return view('backend.our_contents.list', compact('title', 'our_contents'));
    } // End Method

    public function OurContentEdit($id)
    {
        $title = 'Our Content Edit';

        $our_content = OurContents::findOrFail($id);

        return view('backend.our_contents.edit', compact('title', 'our_content'));
    } // End Method

    public function OurContentUpdate(Request $request)
    {
        DB::beginTransaction();

        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required|integer',
                'image' => 'image|max:1024',
            ],
            [
                'id.required' => 'ID is required',
                'image.image' => 'Image must be an image',
                'image.max' => 'Image must be less than 1MB',
            ],
        );

        try {
            $data = OurContents::findOrFail($request->id);
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
                $image->resize(900, 500);
                $image->toJpeg(80)->save(base_path('public/uploads/our_contents/' . $name_gen));
                $data->image = 'uploads/our_contents/' . $name_gen;
            }

            $data->save();

            DB::commit();

            return redirect()->route('admin.our-contents.list')->with('success', 'Our Content Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while updating our content: ' . $e->getMessage());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }
        }
    } // End Method
}
