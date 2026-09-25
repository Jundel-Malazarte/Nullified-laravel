<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function store(ContactRequest $request)
    {
        ContactMessage::create($request->validated());

        return redirect()->route('contact')
            ->with('success', 'Thank you for reaching out! We will get back to you shortly.');
    }
}
