<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class GalleryController extends Controller
{
    public function GalleryList()
    {
        $title = 'Gallery List';

        $galleries = Gallery::orderBy('id', 'asc')->get();

        return view('backend.gallery.list', compact('title', 'galleries'));
    } // End Method

    public function GalleryAdd()
    {
        $title = 'Gallery Add';

        return view('backend.gallery.add', compact('title'));
    } // End Method

    public function GalleryStore(Request $request)
    {
        DB::beginTransaction();

        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|max:100',
                'image' => 'required|image|max:1024',
            ],
            [
                'title.required' => 'Title is required',
                'title.max' => 'Title is too long',
                'image.required' => 'Image is required',
                'image.image' => 'Image must be an image',
                'image.max' => 'Image must be less than 1MB',
            ],
        );

        try {
            $data = new Gallery();
            $data->title = $request->title;
            $data->description = $request->description;

            if ($request->file('image')) {
                $image = $request->file('image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $image = $manager->read($image);
                $image->resize(370, 370);
                $image->toJpeg(80)->save(base_path('public/uploads/gallery/' . $name_gen));
                $data->image = 'uploads/gallery/' . $name_gen;
            }

            $data->save();

            DB::commit();

            return redirect()->route('admin.gallery.list')->with('success', 'Gallery Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while creating gallery: ' . $e->getMessage());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }
        }
    } // End Method

    public function GalleryEdit($id)
    {
        $title = 'Gallery Edit';

        $gallery = Gallery::findOrFail($id);

        return view('backend.gallery.edit', compact('title', 'gallery'));
    } // End Method

    public function GalleryUpdate(Request $request)
    {
        DB::beginTransaction();

        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required|integer',
                'title' => 'required|max:100',
                'status' => 'required',
                'image' => 'image|max:1024',
            ],
            [
                'id.required' => 'ID is required',
                'title.required' => 'Title is required',
                'title.max' => 'Title is too long',
                'status.required' => 'Status is required',
                'image.image' => 'Image must be an image',
                'image.max' => 'Image must be less than 1MB',
            ],
        );

        try {
            $data = Gallery::findOrFail($request->id);
            if (!$data) {
                abort(404);
            }
            $data->title = $request->title;
            $data->description = $request->description;
            $data->status = $request->status;

            if ($request->file('image')) {
                if (file_exists(base_path('public/' . $data->image))) {
                    unlink(base_path('public/' . $data->image));
                }
                $image = $request->file('image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $image = $manager->read($image);
                $image->resize(370, 370);
                $image->toJpeg(80)->save(base_path('public/uploads/gallery/' . $name_gen));
                $data->image = 'uploads/gallery/' . $name_gen;
            }

            $data->save();

            DB::commit();

            return redirect()->route('admin.gallery.list')->with('success', 'Gallery Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while updating gallery: ' . $e->getMessage());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }
        }
    } // End Method

    public function GalleryDelete($id)
    {
        DB::beginTransaction();

        try {
            $data = Gallery::find($id);
            if (file_exists(base_path('public/' . $data->image))) {
                unlink(base_path('public/' . $data->image));
            }
            $data->delete();

            DB::commit();

            return redirect()->route('admin.gallery.list')->with('success', 'Gallery Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while deleting gallery: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    } // End Method
}
