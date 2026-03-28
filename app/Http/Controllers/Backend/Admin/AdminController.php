<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Blog;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\OurTeam;
use App\Models\Service;
use App\Models\Slider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        $slider = Slider::where('status', 'active')->latest()->get();

        $about_us = AboutUs::where('id', 1)->latest()->get();

        $chairman_message = AboutUs::where('id', 2)->latest()->get();

        $our_team = OurTeam::where('status', 'active')->latest()->get();

        $service = Service::where('status', 'active')->latest()->get();

        $galleries = Gallery::all();

        $contact_message = Contact::latest()->get();

        return view('backend.admin.index', compact('slider', 'about_us', 'chairman_message', 'our_team', 'service', 'galleries', 'contact_message'));
    } // End Method

    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    } // End Method

    public function AdminProfile()
    {
        $title = 'Admin Profile';
        $admin_profile = Auth::user(); // Assuming the logged-in user is the admin
        return view('backend.admin.profile', compact('title', 'admin_profile'));
    } // End Method

    public function AdminProfileUpdate(Request $request)
    {
        DB::beginTransaction();

        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required|integer',
                'name' => 'required|max:100',
                'email' => 'required|max:100',
                'thumbnail' => 'image|max:1024',
            ],
            [
                'id.required' => 'ID is required',
                'name.required' => 'Name is required',
                'name.max' => 'Name is too long',
                'email.required' => 'Email is required',
                'email.max' => 'Email is too long',
                'thumbnail.image' => 'Thumbnail must be an image',
                'thumbnail.max' => 'Thumbnail must be less than 1MB',
            ],
        );

        try {
            $data = User::findOrFail($request->id);
            if (!$data) {
                abort(404);
            }
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phone = $request->phone;
            $data->address = $request->address;

            if ($request->file('thumbnail')) {
                if (file_exists(base_path('public/' . $data->thumbnail))) {
                    unlink(base_path('public/' . $data->thumbnail));
                }
                $thumbnail = $request->file('thumbnail');
                $manager = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $thumbnail->getClientOriginalExtension();
                $image = $manager->read($thumbnail);
                // $image->resize(1600, 700);
                $image->toJpeg(80)->save(base_path('public/uploads/admin_profile/' . $name_gen));
                $data->thumbnail = 'uploads/admin_profile/' . $name_gen;
            }

            $data->save();

            DB::commit();

            return redirect()->route('admin.profile')->with('success', 'Admin Profile Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while updating admin profile: ' . $e->getMessage());

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            } else {
                return redirect()->back()->with('error', 'Something Went Wrong!');
            }
        }
    } // End Method

    public function AdminPasswordUpdate(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required|integer',
                'old_password' => 'required',
                'new_password' => 'required|min:8|confirmed',
            ],
            [
                'id.required' => 'ID is required',
                'old_password.required' => 'Current Password is required',
                'new_password.required' => 'New Password is required',
                'new_password.min' => 'New Password must be at least 8 characters',
                'new_password.confirmed' => 'New Password confirmation does not match',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $user = User::findOrFail($request->id);
            if (!$user || !Hash::check($request->old_password, $user->password)) {
                return redirect()->back()->with('error', 'Current Password does not match');
            }

            $user->password = Hash::make($request->new_password);
            $user->save();

            return redirect()->route('admin.profile')->with('success', 'Password Updated Successfully');
        } catch (\Exception $e) {
            Log::error('Error occurred while updating password: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    } // End Method
}
