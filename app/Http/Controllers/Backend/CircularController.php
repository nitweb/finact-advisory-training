<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Circular;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CircularController extends Controller
{
    public function CircularList()
    {
        $title = 'Notice/Circular List';

        $circular = Circular::orderBy('id', 'asc')->get();

        return view('backend.circular.list', compact('title', 'circular'));
    } // End Method

    public function CircularAdd()
    {
        $title = 'Notice/Circular Add';

        return view('backend.circular.add', compact('title'));
    } // End Method

    public function CircularStore(Request $request)
    {
        DB::beginTransaction();

        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|max:255',
                'files' => 'required',
                'files.*' => 'file|mimes:pdf,doc,docx|max:2048',
            ],
            [
                'title.required' => 'Title is required',
                'title.max' => 'Title is too long',
                'files.required' => 'Files are required',
                'files.*.file' => 'Each file must be a file',
                'files.*.mimes' => 'Each file must be a PDF, DOC, or DOCX',
                'files.*.max' => 'Each file must be less than 2MB',
            ],
        );

        try {
            $data = new Circular();
            $data->title = $request->title;

            if ($request->file('files')) {
                $file_input = $request->file('files');
                $name_gen = uniqid() . '.' . $file_input->getClientOriginalExtension();
                $file_input->move(public_path('uploads/circular'), $name_gen);
                $data->files = 'uploads/circular/' . $name_gen;
            }

            $data->save();

            DB::commit();

            return redirect()->route('admin.circular.list')->with('success', 'Circular Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while creating circular: ' . $e->getMessage());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }
        }
    } // End Method

    public function CircularEdit($id)
    {
        $title = 'Notice/Circular Edit';

        $circular = Circular::findOrFail($id);

        return view('backend.circular.edit', compact('title', 'circular'));
    } // End Method

    public function CircularUpdate(Request $request)
    {
        DB::beginTransaction();

        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required|integer',
                'title' => 'max:255',
                'files.*' => 'file|mimes:pdf,doc,docx|max:2048',
            ],
            [
                'id.required' => 'ID is required',
                'title.max' => 'Title is too long',
                'files.*.file' => 'Each file must be a file',
                'files.*.mimes' => 'Each file must be a PDF, DOC, or DOCX',
                'files.*.max' => 'Each file must be less than 2MB',
            ],
        );

        try {
            $data = Circular::findOrFail($request->id);
            if (!$data) {
                abort(404);
            }
            $data->title = $request->title;

            if ($request->hasFile('files')) {
                $filePath = base_path('public/' . $data->files);
                if (!empty($data->files) && file_exists($filePath)) {
                    unlink($filePath);
                }
                $file_input = $request->file('files');
                $name_gen = uniqid() . '.' . $file_input->getClientOriginalExtension();
                $file_input->move(public_path('uploads/circular'), $name_gen);
                $data->files = 'uploads/circular/' . $name_gen;
            }

            $data->save();

            DB::commit();

            return redirect()->route('admin.circular.list')->with('success', 'Circular Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while updating circular: ' . $e->getMessage());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }
        }
    } // End Method

    public function CircularDelete($id)
    {
        DB::beginTransaction();

        try {
            $data = Circular::find($id);

            if (file_exists(base_path('public/' . $data->files))) {
                unlink(base_path('public/' . $data->files));
            }
            $data->delete();

            DB::commit();

            return redirect()->route('admin.circular.list')->with('success', 'Circular Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while deleting circular: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    } // End Method
}
