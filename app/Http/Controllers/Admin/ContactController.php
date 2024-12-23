<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Traits\DeletionRequest;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    use DeletionRequest;

    public function __construct()
    {
        $this->middleware('can:contacts');
    }

    public function index(Request $request)
    {
        $query = Contact::latest();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $contacts = $query->paginate(10);

        if ($request->ajax()) {
            return response()->json(view('Admin.Contacts.list', compact('contacts'))->render());
        }

        return view('Admin.Contacts.index' , compact('contacts'));
    }


    public function destroy(Request $request)
    {
        return $this->deletionRequest($request, 'contact_id', Contact::class);
    }


    public function show($id)
    {
        $contact = Contact::findOrFail($id);

        if ($contact->status == Contact::UNREAD) {
            $contact->update(['status' => Contact::READ]);
        }

        $notification = auth('admin')->user()->unreadNotifications()
            ->where('type','ContactNotification')
            ->where('data->showContactLink', route('admin.contacts.show', $id))
            ->first();

        if ($notification) {
            $notification->markAsRead();
        }

        return view('Admin.Contacts.show' , compact('contact'));
    }
}