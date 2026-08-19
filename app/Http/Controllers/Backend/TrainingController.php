<?php
// app/Http/Controllers/Backend/TrainingController.php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Training;
use App\Models\Trainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class TrainingController extends Controller
{
    // LIST
    public function TrainingList()
    {
        $title         = 'Academy List';
        $training_list = Training::orderBy('id', 'asc')->get();
        return view('backend.training.list', compact('title', 'training_list'));
    }

    // ADD FORM
    public function TrainingAdd()
    {
        $title    = 'Add Academy';
        $trainers = Trainer::all();
        return view('backend.training.add', compact('title', 'trainers'));
    }

    // STORE
    public function TrainingStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title'                 => 'required|max:100',
            'training_image'         => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'short_description'     => 'required|string|max:250',
            'long_description'      => 'required|string',
            'type'                  => 'nullable|in:online,offline',
            'course_start'          => 'nullable|date',
            'registration_deadline' => 'nullable|date',
            'duration'              => 'nullable|string|max:100',
            'no_of_classes'         => 'nullable|integer|min:0',
            'registration_fee'      => 'nullable|integer|min:0',
            'regular_fee'           => 'nullable|integer|min:0',
            'certification'         => 'nullable|string|max:255',
            'trainer_ids'           => 'nullable|array',
            'trainer_ids.*'         => 'integer|exists:trainers,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $training = new Training();
            $training->title                 = $request->title;
            $training->slug                  = Str::slug($request->slug ?: $request->title);
            $training->type                  = $request->type;
            $training->course_start          = $request->course_start;
            $training->registration_deadline = $request->registration_deadline;
            $training->duration              = $request->duration;
            $training->no_of_classes         = $request->no_of_classes;
            $training->registration_fee      = $request->registration_fee;
            $training->regular_fee           = $request->regular_fee;
            $training->certification         = $request->certification;
            $training->short_description     = $request->short_description;
            $training->long_description      = $request->long_description;
            $training->meta_title            = $request->meta_title;
            $training->meta_description      = $request->meta_description;
            $training->meta_keyword          = $request->meta_keyword;
            $training->status                = 'active';
            $training->created_by            = Auth::id();

            // Service Image (960x720)
            if ($request->file('training_image')) {
                $img      = $request->file('training_image');
                $manager  = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                $manager->read($img)->resize(850, 400)->toJpeg(80)
                    ->save(base_path('public/uploads/trainings/' . $name_gen));
                $training->training_image = 'uploads/trainings/' . $name_gen;
            }

            // Banner Image
            if ($request->file('training_banner_image')) {
                $banner   = $request->file('training_banner_image');
                $manager  = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $banner->getClientOriginalExtension();
                $manager->read($banner)->toJpeg(80)
                    ->save(base_path('public/uploads/trainings/' . $name_gen));
                $training->training_banner_image = 'uploads/trainings/' . $name_gen;
            }

            $training->save();
            $training->trainers()->sync($request->trainer_ids ?? []);

            DB::commit();
            return redirect()->route('admin.training.list')->with('success', 'Training created successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Training store error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!')->withInput();
        }
    }

    // EDIT FORM
    public function TrainingEdit($id)
    {
        $title         = 'Edit Academy';
        $trainers      = Trainer::all();
        $training_info = Training::with('trainers')->findOrFail($id);
        return view('backend.training.edit', compact('title', 'trainers', 'training_info'));
    }

    // UPDATE
    public function TrainingUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id'                    => 'required|integer',
            'title'                 => 'required|max:100',
            'training_image'         => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'short_description'     => 'required|string|max:250',
            'long_description'      => 'required|string',
            'status'                => 'required',
            'type'                  => 'nullable|in:online,offline',
            'course_start'          => 'nullable|date',
            'registration_deadline' => 'nullable|date',
            'duration'              => 'nullable|string|max:100',
            'no_of_classes'         => 'nullable|integer|min:0',
            'registration_fee'      => 'nullable|integer|min:0',
            'regular_fee'           => 'nullable|integer|min:0',
            'certification'         => 'nullable|string|max:255',
            'trainer_ids'           => 'nullable|array',
            'trainer_ids.*'         => 'integer|exists:trainers,id',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();
        try {
            $training = Training::findOrFail($request->id);
            $training->title                 = $request->title;
            $training->slug                  = Str::slug($request->slug ?: $request->title);
            $training->status                = $request->status;
            $training->type                  = $request->type;
            $training->course_start          = $request->course_start;
            $training->registration_deadline = $request->registration_deadline;
            $training->duration              = $request->duration;
            $training->no_of_classes         = $request->no_of_classes;
            $training->registration_fee      = $request->registration_fee;
            $training->regular_fee           = $request->regular_fee;
            $training->certification         = $request->certification;
            $training->short_description     = $request->short_description;
            $training->long_description      = $request->long_description;
            $training->meta_title            = $request->meta_title;
            $training->meta_description      = $request->meta_description;
            $training->meta_keyword          = $request->meta_keyword;
            $training->updated_by            = Auth::id();

            // Service Image
            if ($request->file('training_image')) {
                if ($training->training_image && file_exists(public_path($training->training_image))) {
                    unlink(public_path($training->training_image));
                }
                $img      = $request->file('training_image');
                $manager  = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
                $manager->read($img)->resize(850, 400)->toJpeg(80)
                    ->save(base_path('public/uploads/trainings/' . $name_gen));
                $training->training_image = 'uploads/trainings/' . $name_gen;
            }

            // Banner Image
            if ($request->file('training_banner_image')) {
                if ($training->training_banner_image && file_exists(public_path($training->training_banner_image))) {
                    unlink(public_path($training->training_banner_image));
                }
                $banner   = $request->file('training_banner_image');
                $manager  = new ImageManager(new Driver());
                $name_gen = hexdec(uniqid()) . '.' . $banner->getClientOriginalExtension();
                $manager->read($banner)->toJpeg(80)
                    ->save(base_path('public/uploads/trainings/' . $name_gen));
                $training->training_banner_image = 'uploads/trainings/' . $name_gen;
            }

            $training->save();
            $training->trainers()->sync($request->trainer_ids ?? []);

            DB::commit();
            return redirect()->back()->with('success', 'Training updated successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Training update error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!')->withInput();
        }
    }

    // DELETE
    public function TrainingDelete($id)
    {
        DB::beginTransaction();
        try {
            $training = Training::findOrFail($id);

            if ($training->training_image && file_exists(public_path($training->training_image))) {
                unlink(public_path($training->training_image));
            }
            if ($training->training_banner_image && file_exists(public_path($training->training_banner_image))) {
                unlink(public_path($training->training_banner_image));
            }

            $training->trainers()->detach();
            $training->delete();

            DB::commit();
            return redirect()->back()->with('success', 'Training deleted successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Training delete error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong!');
        }
    }
}
