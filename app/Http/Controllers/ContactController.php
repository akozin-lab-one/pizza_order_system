<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //contact list
    public function MessageList(){
        $messages = Contact::when(request('key'), function($query){
                        $query->orwhere('name', 'like', '%'.request('key').'%')
                              ->orwhere('email', 'like', '%'.request('key').'%');
                    })
                    ->orderBy('id', 'desc')
                    ->paginate(5);
        return view('Admin.contact.contactmessage', compact('messages'));
    }

    //message detail
    public function MessageDetail($id){
        $message = Contact::where('id', $id)->first();
        $user = User::where('role', 'user')->first();
        return view('Admin.contact.contactDetail', compact('message', 'user'));
    }

    //delete page
    public function DeleteMessage($id){
        Contact::where('id', $id)->delete();
        return back();
    }
}
