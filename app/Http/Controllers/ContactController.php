<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:100'],
            'message' => ['required', 'string' , 'max:1000'],
        ]);

        $validated['ip_address'] = $request->ip();

        Contact::create($validated);

        return back()->with('status', 'Message sent successfully!');
    }
}
