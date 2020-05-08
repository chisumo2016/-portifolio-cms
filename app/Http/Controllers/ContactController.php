<?php

namespace App\Http\Controllers;

use App\Mail\ContactSubmission;
use App\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{

    public function store(Request $request)
    {
        $data  = $request->validate([
            'email'      => 'required|email',
            'message'    => 'required',
        ]);

          Mail::to(config('variables.contact_to_email'))->send(new ContactSubmission($data));

        return response()
            ->json([
                'message' => 'Mail Sent Successfully',
            ]);
    }

}
