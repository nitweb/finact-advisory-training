<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\OurTeam;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;

class OurTeamController extends Controller
{
    public function OurTeamList()
    {
        $title = 'Our Team List';

        $our_teams = OurTeam::orderBy('id', 'asc')->get();

        return view('backend.our_team.list', compact('title', 'our_teams'));
    } // End Method

    public function OurTeamAdd()
    {
        $title = 'Our Team Add';

        return view('backend.our_team.add', compact('title'));
    } // End Method

    public function OurTeamStore(Request $request)
    {
        DB::beginTransaction();

        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'required|max:100',
                'designation' => 'required|max:100',
                'type' => 'required',
                'team_image' => 'required|image|max:1024',
            ],
            [
                'name.required' => 'Name is required',
                'name.max' => 'Name is too long',
                'designation.required' => 'Designation is required',
                'designation.max' => 'Designation is too long',
                'type.required' => 'Type is required',
                'team_image.required' => 'Image is required',
                'team_image.image' => 'Image must be an image',
                'team_image.max' => 'Image must be less than 1MB',
            ],
        );

        try {
            $data = new OurTeam();
            $data->name = $request->name;
            $data->slug = Str::slug($request->name . ' ' . $request->designation);
            $data->designation = $request->designation;
            $data->description = $request->description;
            $data->type = $request->type;
            $data->created_by = Auth::user()->id;
            $data->updated_by = null;

            if ($request->file('team_image')) {
                $team_image = $request->file('team_image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $team_image->getClientOriginalExtension();
                $image = $manager->read($team_image);
                $image->resize(306, 337);
                $image->toJpeg(80)->save(base_path('public/uploads/our_team/' . $name_gen));
                $data->team_image = 'uploads/our_team/' . $name_gen;
            }

            $data->save();

            DB::commit();

            return redirect()->route('admin.our-team.list')->with('success', 'Team Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while creating our team: ' . $e->getMessage());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }
        }
    } // End Method

    public function OurTeamEdit($id)
    {
        $title = 'Our Team Edit';

        $our_team = OurTeam::findOrFail($id);

        return view('backend.our_team.edit', compact('title', 'our_team'));
    } // End Method

    public function OurTeamUpdate(Request $request)
    {
        DB::beginTransaction();

        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required|integer',
                'name' => 'required|max:100',
                'designation' => 'required|max:100',
                'type' => 'required',
                'status' => 'required',
                'team_image' => 'image|max:1024',
            ],
            [
                'id.required' => 'ID is required',
                'name.required' => 'Name is required',
                'name.max' => 'Name is too long',
                'designation.required' => 'Designation is required',
                'designation.max' => 'Designation is too long',
                'type.required' => 'Type is required',
                'status.required' => 'Status is required',
                'team_image.image' => 'Image must be an image',
                'team_image.max' => 'Image must be less than 1MB',
            ],
        );

        try {
            $data = OurTeam::findOrFail($request->id);
            if (!$data) {
                abort(404);
            }
            $data->name = $request->name;
            $data->slug = Str::slug($request->name . ' ' . $request->designation);
            $data->designation = $request->designation;
            $data->description = $request->description;
            $data->type = $request->type;
            $data->status = $request->status;
            $data->created_by = null;
            $data->updated_by = Auth::user()->id;

            if ($request->file('team_image')) {
                if (file_exists(base_path('public/' . $data->team_image))) {
                    unlink(base_path('public/' . $data->team_image));
                }
                $team_image = $request->file('team_image');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $team_image->getClientOriginalExtension();
                $image = $manager->read($team_image);
                $image->resize(306, 337);
                $image->toJpeg(80)->save(base_path('public/uploads/our_team/' . $name_gen));
                $data->team_image = 'uploads/our_team/' . $name_gen;
            }

            $data->save();

            DB::commit();

            return redirect()->route('admin.our-team.list')->with('success', 'Team Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while updating our team: ' . $e->getMessage());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }
        }
    } // End Method

    public function OurTeamDelete($id)
    {
        DB::beginTransaction();

        try {
            $our_team = OurTeam::find($id);
            if (file_exists(base_path('public/' . $our_team->team_image))) {
                unlink(base_path('public/' . $our_team->team_image));
            }
            $our_team->delete();

            DB::commit();

            return redirect()->route('admin.our-team.list')->with('success', 'Team Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while deleting our team: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    } // End Method
}
