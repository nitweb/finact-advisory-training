<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Enrollment;
use App\Models\Training;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;

class TrainingEnrollmentController extends Controller
{
    public function EnrollPage($slug)
    {
        $training = Training::where('slug', $slug)->where('status', 'active')->firstOrFail();

        return view('frontend.pages.enroll', compact('training'));
    }

    // Form submit
    public function EnrollSubmit(Request $request)
    {
        $request->validate([
            'training_id' => 'required|integer|exists:trainings,id',
            'name' => 'required|string|max:120',
            'phone' => 'required|string|max:30',
            'email' => 'nullable|email|max:120',
            'address' => 'nullable|string|max:255',
            'note' => 'nullable|string|max:500',
            'bkash_number' => 'required|string|max:30',
            'bkash_trx_id' => 'required|string|max:100',
        ]);

        DB::beginTransaction();
        try {
            $training = Training::findOrFail($request->training_id);

            $invoice = 'TRN-' . now()->format('YmdHis') . '-' . strtoupper(Str::random(5));

            $enrollment = Enrollment::create([
                'training_id' => $training->id,
                'invoice' => $invoice,
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'note' => $request->note,
                'bkash_number' => $request->bkash_number,
                'bkash_trx_id' => $request->bkash_trx_id,
                'amount' => $training->registration_fee ?? 0,
                'status' => 'pending',
            ]);

            DB::commit();

            return redirect()->route('frontend.training.enroll.success', $enrollment->invoice);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Enrollment Error: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong! Please try again.')->withInput();
        }
    }

    // Success page
    public function EnrollSuccess($invoice)
    {
        $enrollment = Enrollment::with('training')->where('invoice', $invoice)->firstOrFail();

        return view('frontend.pages.enroll_success', compact('enrollment'));
    }

    // ── Backend List ──
    public function index()
    {
        $title = 'Training Enrollment List';

        $enrollment_info = Enrollment::with(['training'])
            ->orderBy('id', 'asc')
            ->get();

        return view('backend.training_enrollment.list', compact('title', 'enrollment_info'));
    }

    // ── Backend Show ──
    public function show(Enrollment $enrollment)
    {
        $title = 'Enrollment Details';
        $enrollment->load('training');
        return view('backend.training_enrollment.show', compact('title', 'enrollment'));
    }

    // ── Delete ──
    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        return redirect()->route('admin.training.enrollment.list')->with('success', 'Enrollment deleted successfully.');
    }

    // ── AJAX Status Update ──
    public function updateStatus(Request $request, Enrollment $enrollment)
    {
        $request->validate([
            'status' => 'required|in:pending,paid,failed,cancelled',
        ]);

        $enrollment->update(['status' => $request->status]);

        $badge = match ($enrollment->status) {
            'paid' => 'success',
            'pending' => 'info',
            'failed' => 'danger',
            'cancelled' => 'secondary',
            default => 'dark',
        };

        return response()->json([
            'success' => true,
            'status' => $enrollment->status,
            'label' => ucfirst(str_replace('_', ' ', $enrollment->status)),
            'badge' => $badge,
        ]);
    }

    public function downloadInvoice($invoice)
    {
        $enrollment = Enrollment::with('training')->where('invoice', $invoice)->firstOrFail();

        $pdf = Pdf::loadView('frontend.pdf.enrollment_invoice', compact('enrollment'))->setPaper('a4', 'portrait');

        return $pdf->download($enrollment->invoice . '.pdf');
    }
}
