<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Mail\ContactFormMail;
use App\Models\Contact;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function ContactList()
    {
        $title = 'Contact Message List';

        $contact_message = Contact::latest()->get();

        return view('backend.contact.list', compact('title', 'contact_message'));
    } // End Method

    public function ContactStore(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => 'max:100',
                'email' => 'email|max:100',
                'phone' => 'max:20',
                'subject' => 'nullable|max:200',
                'organization' => 'nullable|max:200',
                'service' => 'nullable',
            ],
            [
                'name.max' => 'Name must be less than 100 characters.',
                'email.email' => 'Please enter a valid email address.',
                'email.max' => 'Email must be less than 100 characters.',
                'phone.max' => 'Phone number must be less than 20 characters.',
                'subject.max' => 'Subject must be less than 200 characters.',
                'organization.max' => 'Organization must be less than 200 characters.',
            ],
        );

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        DB::beginTransaction();

        try {
            // Save the contact form data
            $contact = new Contact();
            $contact->name = $request->name;
            $contact->email = $request->email;
            $contact->phone = $request->phone;
            $contact->subject = $request->subject;
            $contact->message = $request->message;
            $contact->organization = $request->organization;
            $contact->service = Service::find($request->service)?->title ?? null;
            $contact->save();

            // Prepare email data
            $emailData = [
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'subject' => $request->subject,
                'organization' => $request->organization,
                'service' => $request->service,
                'message' => $request->message,
            ];

            // Send the email
            Mail::to('ceo@mazamanca.com')->send(new ContactFormMail($emailData));

            DB::commit();

            return redirect()->back()->with('success', 'Contact Message Sent Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while creating contact message: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    }

    public function ContactDelete($id)
    {
        DB::beginTransaction();

        try {
            $contact = Contact::findOrFail($id);
            $contact->delete();

            DB::commit();

            return redirect()->route('admin.contact.list')->with('success', 'Contact Message Deleted Successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error occurred while deleting contact message: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Something Went Wrong!');
        }
    } // End Method

    public function deleteSelected(Request $request)
    {
        $ids = $request->ids;
        if (!empty($ids)) {
            Contact::whereIn('id', $ids)->delete();
            return redirect()->back()->with('success', 'Selected contacts have been deleted successfully');
        }
        return redirect()->back()->with('error', 'No contacts selected for deletion');
    }
}
