<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function BookList()
    {
        $title = 'Book List';

        $books = Book::orderBy('id', 'asc')->get();

        return view('backend.book.list', compact('title', 'books'));
    } // End Method

    public function BookAdd()
    {
        $title = 'Book Add';

        return view('backend.book.add', compact('title'));
    } // End Method

    public function BookStore(Request $request)
    {
        DB::beginTransaction();

        $validator = Validator::make(
            $request->all(),
            [
                'title' => 'required|max:255',
                'author' => 'nullable|max:150',
                'price' => 'required|integer|min:0',
                'discount_percent' => 'nullable|integer|min:0|max:100',
                'stock' => 'required|integer|min:0',
                'description' => 'nullable',
                'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'sample_pdf' => 'nullable|file|mimes:pdf|max:10240',
                'status' => 'required|in:active,inactive',
            ],
            [
                'title.required' => 'Title is required',
                'price.required' => 'Price is required',
                'stock.required' => 'Stock is required',
                'cover_image.image' => 'Cover must be an image',
                'cover_image.max' => 'Cover image must be less than 2MB',
                'sample_pdf.mimes' => 'Sample must be a PDF',
                'sample_pdf.max' => 'Sample PDF must be less than 10MB',
            ],
        );

        try {
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = new Book();
            $data->title = $request->title;
            $data->slug = Str::slug($request->title) . '-' . uniqid();
            $data->author = $request->author;
            $data->price = $request->price;
            $data->discount_percent = (int) $request->input('discount_percent', 0);
            $data->stock = $request->stock;
            $data->description = $request->description;
            $data->status = $request->status;

            if ($request->file('cover_image')) {
                $file_input = $request->file('cover_image');
                $name_gen = uniqid() . '.' . $file_input->getClientOriginalExtension();
                $file_input->move(public_path('uploads/books'), $name_gen);
                $data->cover_image = 'uploads/books/' . $name_gen;
            }

            if ($request->file('sample_pdf')) {
                $file_input = $request->file('sample_pdf');
                $name_gen = uniqid() . '.' . $file_input->getClientOriginalExtension();
                $file_input->move(public_path('uploads/books/samples'), $name_gen);
                $data->sample_pdf = 'uploads/books/samples/' . $name_gen;
            }

            $data->save();

            DB::commit();

            return redirect()->route('admin.book.list')->with('success', 'Book Created Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while creating book: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Something Went Wrong!')->withInput();
        }
    } // End Method

    public function BookEdit($id)
    {
        $title = 'Book Edit';

        $book = Book::findOrFail($id);

        return view('backend.book.edit', compact('title', 'book'));
    } // End Method

    public function BookUpdate(Request $request)
    {
        DB::beginTransaction();

        $validator = Validator::make(
            $request->all(),
            [
                'id' => 'required|integer',
                'title' => 'required|max:255',
                'author' => 'nullable|max:150',
                'price' => 'required|integer|min:0',
                'discount_percent' => 'nullable|integer|min:0|max:100',
                'stock' => 'required|integer|min:0',
                'description' => 'nullable',
                'cover_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                'sample_pdf' => 'nullable|file|mimes:pdf|max:10240',
                'status' => 'required|in:active,inactive',
            ],
        );

        try {
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }

            $data = Book::findOrFail($request->id);

            $data->title = $request->title;
            $data->author = $request->author;
            $data->price = $request->price;
            $data->discount_percent = (int) $request->input('discount_percent', 0);
            $data->stock = $request->stock;
            $data->description = $request->description;
            $data->status = $request->status;

            if ($request->hasFile('cover_image')) {
                $filePath = base_path('public/' . $data->cover_image);
                if (!empty($data->cover_image) && file_exists($filePath)) {
                    unlink($filePath);
                }

                $file_input = $request->file('cover_image');
                $name_gen = uniqid() . '.' . $file_input->getClientOriginalExtension();
                $file_input->move(public_path('uploads/books'), $name_gen);
                $data->cover_image = 'uploads/books/' . $name_gen;
            }

            if ($request->hasFile('sample_pdf')) {
                $filePath = base_path('public/' . $data->sample_pdf);
                if (!empty($data->sample_pdf) && file_exists($filePath)) {
                    unlink($filePath);
                }

                $file_input = $request->file('sample_pdf');
                $name_gen = uniqid() . '.' . $file_input->getClientOriginalExtension();
                $file_input->move(public_path('uploads/books/samples'), $name_gen);
                $data->sample_pdf = 'uploads/books/samples/' . $name_gen;
            }

            $data->save();

            DB::commit();

            return redirect()->route('admin.book.list')->with('success', 'Book Updated Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while updating book: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Something Went Wrong!')->withInput();
        }
    } // End Method

    public function BookDelete($id)
    {
        try {
            $data = Book::findOrFail($id);

            $filePath = base_path('public/' . $data->cover_image);
            if (!empty($data->cover_image) && file_exists($filePath)) {
                unlink($filePath);
            }

            $samplePath = base_path('public/' . $data->sample_pdf);
            if (!empty($data->sample_pdf) && file_exists($samplePath)) {
                unlink($samplePath);
            }

            $data->delete();

            return redirect()->back()->with('success', 'Book Deleted Successfully');
        } catch (\Exception $e) {
            Log::error('Error occurred while deleting book: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    } // End Method
}
