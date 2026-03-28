<?php

namespace App\Http\Controllers\Backend\Settings;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SettingController extends Controller
{
    public function FontAwesome()
    {
        $title = 'FontAwesome List';
        $icons = icons();

        return view('backend.setting.font_awesome', compact('title'));
    } // End Method

    public function searchIcons(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'query' => 'required|string|min:1',
        ]);

        $query = $request->input('query');

        // Assuming you have a list of icons, you might fetch them from a database or predefined array
        $icons = icons();

        // Filter icons based on the search query
        $filteredIcons = array_filter($icons, function ($icon) use ($query) {
            return stripos($icon, $query) !== false;
        });

        return response()->json(array_values($filteredIcons));
    } // End Method

    public function SettingEdit($id)
    {
        $title = 'Site Setting';

        $site_setting = Setting::findOrFail($id);

        return view('backend.setting.site_setting', compact('title', 'site_setting'));
    } // End Method

    public function SettingUpdate(Request $request)
    {
        DB::beginTransaction();

        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required|integer',
            ],
            [
                'id.required' => 'ID is required',
            ],
        );

        try {
            $data = Setting::findOrFail($request->id);
            if (!$data) {
                abort(404);
            }
            $data->copyright = $request->copyright;
            $data->footer_text = $request->footer_text;
            $data->facebook = $request->facebook;
            $data->youtube = $request->youtube;
            $data->linkedin = $request->linkedin;
            $data->instagram = $request->instagram;

            $data->head_address = $request->head_address;
            $data->branch_address = $request->branch_address;
            $data->site_phone = $request->site_phone;
            $data->site_phone_alter = $request->site_phone_alter;
            $data->site_email = $request->site_email;

            if ($request->file('header_logo')) {
                if (file_exists(base_path('public/' . $data->header_logo))) {
                    unlink(base_path('public/' . $data->header_logo));
                }
                $header_logo = $request->file('header_logo');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $header_logo->getClientOriginalExtension();
                $image = $manager->read($header_logo);
                // $image->resize(306, 337);
                $image->save(base_path('public/uploads/site_setting/' . $name_gen));
                $data->header_logo = 'uploads/site_setting/' . $name_gen;
            }

            if ($request->file('footer_logo')) {
                if (file_exists(base_path('public/' . $data->footer_logo))) {
                    unlink(base_path('public/' . $data->footer_logo));
                }
                $footer_logo = $request->file('footer_logo');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $footer_logo->getClientOriginalExtension();
                $image = $manager->read($footer_logo);
                // $image->resize(306, 337);
                $image->save(base_path('public/uploads/site_setting/' . $name_gen));
                $data->footer_logo = 'uploads/site_setting/' . $name_gen;
            }

            $data->save();

            DB::commit();

            return redirect()->back()->with('success', 'Site Setting Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while updating site setting: ' . $e->getMessage());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }
        }
    } // End Method
}
