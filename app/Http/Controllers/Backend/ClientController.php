<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ClientController extends Controller
{
    public function ClientList()
    {
        $title = 'Client List';

        $clients = Client::orderBy('id', 'asc')->get();

        return view('backend.client.list', compact('title', 'clients'));
    } // End Method

    public function ClientAdd()
    {
        $title = 'Client Add';

        return view('backend.client.add', compact('title'));
    } // End Method

    public function ClientStore(Request $request)
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
            $data = new Client();
            $data->title = $request->title;

            if ($request->file('image')) {
                $image = $request->file('image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $image = $manager->read($image);
                // $image->resize(270, 150);
                $image->toJpeg(80)->save(base_path('public/uploads/client/' . $name_gen));
                $data->image = 'uploads/client/' . $name_gen;
            }

            $data->save();

            DB::commit();

            return redirect()->route('admin.client.list')->with('success', 'Client Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while creating client: ' . $e->getMessage());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }
        }
    } // End Method

    public function ClientEdit($id)
    {
        $title = 'Client Edit';

        $client = Client::findOrFail($id);

        return view('backend.client.edit', compact('title', 'client'));
    } // End Method

    public function ClientUpdate(Request $request)
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
            $data = Client::findOrFail($request->id);
            if (!$data) {
                abort(404);
            }
            $data->title = $request->title;
            $data->status = $request->status;

            if ($request->file('image')) {
                if (file_exists(base_path('public/' . $data->image))) {
                    unlink(base_path('public/' . $data->image));
                }
                $image = $request->file('image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
                $image = $manager->read($image);
                // $image->resize(270, 150);
                $image->toJpeg(80)->save(base_path('public/uploads/client/' . $name_gen));
                $data->image = 'uploads/client/' . $name_gen;
            }

            $data->save();

            DB::commit();

            return redirect()->route('admin.client.list')->with('success', 'Client Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while updating client: ' . $e->getMessage());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }
        }
    } // End Method

    public function ClientDelete($id)
    {
        DB::beginTransaction();

        try {
            $data = Client::find($id);
            if (file_exists(base_path('public/' . $data->image))) {
                unlink(base_path('public/' . $data->image));
            }
            $data->delete();

            DB::commit();

            return redirect()->route('admin.client.list')->with('success', 'Client Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while deleting client: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    } // End Method
}
