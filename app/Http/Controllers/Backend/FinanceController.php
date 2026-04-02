<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Finance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class FinanceController extends Controller
{
    public function FinanceList()
    {
        $title = 'Global Remote Finance Support';

        $finance_list = Finance::latest()->get();

        return view('backend.finance.list', compact('title', 'finance_list'));
    } // End Method

    public function FinanceEdit($id)
    {
        $title = 'Global Remote Finance Support';

        $finance_info = Finance::findOrFail($id);

        return view('backend.finance.edit', compact('title', 'finance_info'));
    } // End Method

    public function FinanceUpdate(Request $request)
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
            $data = Finance::findOrFail($request->id);
            if (!$data) {
                abort(404);
            }
            $data->long_description = $request->long_description;
            $data->updated_at = now();
            $data->save();

            DB::commit();

            return redirect()->back()->with('success', 'Global Remote Finance Support Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while updating Global Remote Finance Support: ' . $e->getMessage());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }
        }
    } // End Method
}
