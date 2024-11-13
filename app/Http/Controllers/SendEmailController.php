<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;
use App\Mail\UserRegisteredEmail;
use App\Jobs\SendMailJob;

class SendEmailController extends Controller
{
    public function index() {
        return view('emails.kirim-email');
    }

    public function store(Request $request) {
        $data = $request->all();
        dispatch(new SendMailJob($data));
        return redirect()->route('kirim-email')->with('success','Email berhasil dikirim');
    }
}
