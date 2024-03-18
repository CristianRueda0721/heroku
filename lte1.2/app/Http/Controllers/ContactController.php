<?php

namespace App\Http\Controllers;
use App\Mail\ContactUS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Jobs\ContactUsJob;
use App\Models\Message;


class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function send() 
    {

         $data = request()->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'message' => 'required|min:5',
         ]);
        //Mail::to('servicentronotif@gmail.com')->send(new ContactUS($data));
         
        Message::create($data);
        $job = (new ContactUsJob($data));
        dispatch($job);

        // dd('sent');
        return redirect()->back()->with('success','El correo electrónico ha sido enviado');
    }

}
