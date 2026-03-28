<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\SuccessfulPortfolios;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SuccessfulPortfoliosController extends Controller
{
    public function SuccessfulPortfoliosList()
    {
        $title = 'Firm Profile';

        $successful_portfolios = SuccessfulPortfolios::latest()->get();

        return view('backend.successful_portfolios.list', compact('title', 'successful_portfolios'));
    } // End Method

    public function SuccessfulPortfoliosEdit($id)
    {
        $title = 'Firm Profile Edit';

        $successful_portfolios = SuccessfulPortfolios::get()->first();

        return view('backend.successful_portfolios.edit', compact('title', 'successful_portfolios'));
    } // End Method

    public function SuccessfulPortfoliosUpdate(Request $request)
    {
        DB::beginTransaction();

        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required|integer',
                'pdf_image' => 'required',
                'pdf_file' => 'required',
            ],
            [
                'id.required' => 'ID is required',
                'pdf_image.required' => 'Image is required',
                'pdf_file.required' => 'PDF is required',
            ],
        );

        try {
            $data = SuccessfulPortfolios::find($request->id);
            if (!$data) {
                abort(404);
            }

            if ($request->file('pdf_image')) {
                if (!empty($data->pdf_image) && file_exists(base_path('public/' . $data->pdf_image))) {
                    unlink(base_path('public/' . $data->pdf_image));
                }
                $pdf_image = $request->file('pdf_image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $pdf_image->getClientOriginalExtension();
                $image = $manager->read($pdf_image);
                // $image->resize(306, 337);
                $image->toJpeg(80)->save(base_path('public/uploads/pdf_image/' . $name_gen));
                $data->pdf_image = 'uploads/pdf_image/' . $name_gen;
            }

            if ($request->hasFile('pdf_file')) {
                $pdfPath = base_path('public/' . $data->pdf_file);
                if (!empty($data->pdf_file) && file_exists($pdfPath)) {
                    unlink($pdfPath);
                }
                $pdf = $request->file('pdf_file');
                $name_gen = uniqid() . '.' . $pdf->getClientOriginalExtension();
                $pdf->move(public_path('uploads/pdf_file'), $name_gen);
                $data->pdf_file = 'uploads/pdf_file/' . $name_gen;
            }

            $data->save();

            DB::commit();

            return redirect()->route('admin.successful_portfolios.list')->with('success', 'Firm Profile Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while updating Firm Profile: ' . $e->getMessage());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }
        }
    } // End Method
}
