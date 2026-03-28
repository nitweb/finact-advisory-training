<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\WhoWeAre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class WhoWeAreController extends Controller
{
    public function WhoWeAreList()
    {
        $title = 'Who We Are List';

        $who_we_ares = WhoWeAre::latest()->get();

        return view('backend.who_we_are.list', compact('title', 'who_we_ares'));
    } // End Method

    public function WhoWeAreEdit($id)
    {
        $title = 'Who We Are Edit';

        $who_we_are = WhoWeAre::findOrFail($id);

        return view('backend.who_we_are.edit', compact('title', 'who_we_are'));
    } // End Method

    public function WhoWeAreUpdate(Request $request)
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
            $data = WhoWeAre::findOrFail($request->id);
            if (!$data) {
                abort(404);
            }
            $data->description = $request->description;
            $data->save();

            DB::commit();

            return redirect()->route('admin.who-we-are.list')->with('success', 'Who We Are Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while updating who we are: ' . $e->getMessage());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }
        }
    } // End Method
}
