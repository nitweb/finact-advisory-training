<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class TrainingController extends Controller
{
    public function TrainingList()
    {
        $title = 'Training & Development';

        $training_list = Training::latest()->get();

        return view('backend.training.list', compact('title', 'training_list'));
    } // End Method

    public function TrainingEdit($id)
    {
        $title = 'Training & Development';

        $training_info = Training::findOrFail($id);

        return view('backend.training.edit', compact('title', 'training_info'));
    } // End Method

    public function TrainingUpdate(Request $request)
    {
        DB::beginTransaction();

        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required|integer',
                'long_description' => 'required',
            ],
            [
                'id.required' => 'ID is required',
                'long_description.required' => 'Description is required',
            ],
        );

        try {
            $data = Training::findOrFail($request->id);
            if (!$data) {
                abort(404);
            }
            $data->long_description = $request->long_description;
            $data->updated_at = now();
            $data->save();

            DB::commit();

            return redirect()->back()->with('success', 'Training & Development Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while updating Training & Development: ' . $e->getMessage());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }
        }
    } // End Method
}
