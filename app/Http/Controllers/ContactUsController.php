<?php   
    namespace App\Http\Controllers;

        use Illuminate\Http\Request;
        use App\Http\Requests;

        class ContactUsController extends Controller
        {
            public function getContact() {
                return view('contact');
            }
            public function postContact(Request $request) {
                $this->validate($request, [
                    'email' => 'required|email',
                    'subject' => 'min:3' 
                ]);

                $data = array(
                    'email' => $request->email,
                    'subject' => $request->subject,
                    'bodyMessage' => $request->message
                );
                Mail::send('emails.contactus', $data, function($message) use($data){
                    $message->from($data['email']);
                    $message->to('shashankasrirama@gmail.com');
                    $message->subject($data['subject']);
                  });
            }
        }