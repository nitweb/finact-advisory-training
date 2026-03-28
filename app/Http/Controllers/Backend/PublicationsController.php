<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Publications;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PublicationsController extends Controller
{
    public function PublicationsList()
    {
        $title = 'Publications List';

        $publications = Publications::orderBy('id', 'asc')->get();

        return view('backend.publications.list', compact('title', 'publications'));
    } // End Method

    public function PublicationsAdd()
    {
        $title = 'Publication Add';

        return view('backend.publications.add', compact('title'));
    } // End Method

    public function PublicationsStore(Request $request)
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
            $data = new Publications();
            $data->title = $request->title;

            if ($request->file('files')) {
                $file_input = $request->file('files');
                $name_gen = uniqid() . '.' . $file_input->getClientOriginalExtension();
                $file_input->move(public_path('uploads/publications'), $name_gen);
                $data->files = 'uploads/publications/' . $name_gen;
            }

            $data->save();

            DB::commit();

            return redirect()->route('admin.publications.list')->with('success', 'Publications Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while creating publications: ' . $e->getMessage());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }
        }
    } // End Method

    public function PublicationsEdit($id)
    {
        $title = 'Publications Edit';

        $publications = Publications::findOrFail($id);

        return view('backend.publications.edit', compact('title', 'publications'));
    } // End Method

    public function PublicationsUpdate(Request $request)
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
            $data = Publications::findOrFail($request->id);
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
                $file_input->move(public_path('uploads/publications'), $name_gen);
                $data->files = 'uploads/publications/' . $name_gen;
            }

            $data->save();

            DB::commit();

            return redirect()->route('admin.publications.list')->with('success', 'Publications Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while updating publications: ' . $e->getMessage());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }
        }
    } // End Method

    public function PublicationsDelete($id)
    {
        DB::beginTransaction();

        try {
            $data = Publications::find($id);

            if (file_exists(base_path('public/' . $data->files))) {
                unlink(base_path('public/' . $data->files));
            }
            $data->delete();

            DB::commit();

            return redirect()->route('admin.publications.list')->with('success', 'Publications Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while deleting publications: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    } // End Method
}
