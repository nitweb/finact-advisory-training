<?php

namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use App\Models\Blog;
use App\Models\Book;
use App\Models\Order;
use App\Models\Contact;
use App\Models\Enrollment;
use App\Models\Gallery;
use App\Models\OurTeam;
use App\Models\Service;
use App\Models\Slider;
use App\Models\Trainer;
use App\Models\Training;
use App\Models\User;
use App\Services\SmsService;
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
    // public function __construct(SmsService $sms) {
    //     // dd($sms->checkSMSBalance());
    // }    

    public function AdminDashboard(SmsService $sms)
    {
        $services = Service::where('status', 'active')->latest()->get();
        $trainers = Trainer::where('status', 'active')->latest()->get();
        $trainings = Training::where('status', 'active')->latest()->get();
        $enrollments = Enrollment::latest()->get();
        $blogs = Blog::where('status', 'active')->latest()->get();
        $galleries = Gallery::all();
        $contacts = Contact::latest()->get();
        $books = Book::where('status', 'active')->latest()->get();
        $bookOrders = Order::latest()->get();
        $smsBalance = $sms->checkSMSBalance();

        return view('backend.admin.index', compact('services', 'trainers', 'trainings', 'enrollments', 'blogs', 'galleries', 'contacts', 'books', 'bookOrders', 'smsBalance'));
    }

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
