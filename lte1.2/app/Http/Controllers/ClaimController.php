<?php

namespace App\Http\Controllers;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Http\Request;
use App\Models\Claim;
use App\Notifications\SendEmailNotification;
use Notification;
class ClaimController extends Controller
{
    public function showForm()
    {
        return view('claims.form');
    }

    public function submit(Request $request)
    {
        // Validate form data
        $validatedData = $request->validate([
            'nombre' => 'required|string',
            'email' => 'required|email',
            'telefono' => 'required|string',
            'identificacion' => 'required|string',
            'asunto' => 'required|string',
            'mensaje' => 'required|string',
            // Add more validation rules as needed
        ]);

        // Store the claim in the database
        $claim = new Claim();
        $claim->nombre = $validatedData['nombre'];
        $claim->email = $validatedData['email'];
        $claim->telefono = $validatedData['telefono'];
        $claim->identificacion = $validatedData['identificacion'];
        $claim->asunto = $validatedData['asunto'];
        $claim->mensaje = $validatedData['mensaje'];
        $claim->save();

        // Redirect back with a success message
        
        return redirect('/')->with('success', '¡Su mensaje ha sido enviado!');
    }

    public function index()
    {
        // Retrieve all claims from the database
        $claims = Claim::all();
        
        // Pass the claims data to the view
        return view('claims.claims', compact('claims'));
        
    }

    public function updateStatus(Claim $claim)
{
    $statuses = ['Incompleto', 'En progreso', 'Terminado'];
    $currentStatusIndex = array_search($claim->status, $statuses);
    $nextStatusIndex = ($currentStatusIndex + 1) % count($statuses);
    $claim->status = $statuses[$nextStatusIndex];
    $claim->save();

    return response()->json(['status' => $claim->status]);
}


public function send_mail($claim)
{
    $claims = Claim::find($claim);
    return view('claims.send_mail', compact('claims'));


}

/*public function mail(Request $request, $claim)
{
    $claims = Claim::find($claim);
    $details = [
        'name' => $request-> name,
        'email' => $request-> email,
        'message' => $request-> message,
    ];



    Notification::send($claims, new SendEmailNotification($details));
    return redirect()->back();
}
*/

public function mail(Request $request, $claim)
{
    $claims = Claim::find($claim);
    
    $details = [
        'name' => $request->name,
        'message' => $request->message, // Adjusted to match the field name in your form
    ];

    // Instantiate the notification and pass the details
    $notification = new SendEmailNotification($details);

    // Send the notification to the $claims instance
    Notification::send($claims, $notification);

    return redirect()->back();
}

}