<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::paginate(10);
        return view('contacts.contact', compact('contacts'));
    }

    public function store(Request $request)
    {
        if (!auth()->check()) {
            return redirect()->back()->with('error', 'Você precisa estar logado para enviar uma mensagem.');
        }
        
        $validatedData = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $contact = new Contact();
        $contact->name = auth()->user()->name; 
        $contact->email = auth()->user()->email; 
        $contact->subject = $validatedData['subject'];
        $contact->message = $validatedData['message'];
        $contact->save();

        return redirect()->back()->with('success', 'Mensagem enviada com sucesso!');
    }

}
