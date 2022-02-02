<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\EmailTemplate;
use App\User;
use Helper;
use Hash;

class EmailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emails = EmailTemplate::all();
        return view('dashboard.email_templates.index',compact('emails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('dashboard.email_templates.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        // Create email template
        $emailTemplate = new EmailTemplate;
        $emailTemplate->title = $request->input('title');
        $emailTemplate->subject = $request->input('subject');
        $emailTemplate->description = $request->input('message');
        
        $emailTemplate->save();

        return Redirect::back()->with('success', 'Email Template Created');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $emailTemplate = EmailTemplate::find($id);
        $data = array(
            'email' => $emailTemplate
        );
        return view('dashboard.email_templates.show')->with($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $emailTemplate = EmailTemplate::find($id);
        $data = array(
            'email' => $emailTemplate
        );
        return view('dashboard.email_templates.edit')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ]);

        // Create email template
        $emailTemplate = EmailTemplate::find($id);;
        $emailTemplate->title = $request->input('title');
        $emailTemplate->subject = $request->input('subject');
        $emailTemplate->description = $request->input('message');
        
        $emailTemplate->save();

        return Redirect::back()->with('success', 'Email Template Created');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $emailTemplate = EmailTemplate::find($id);

        $emailTemplate->delete();

        return Redirect::back()->with('success', 'Email Template Deleted');
    }

    public function email_offer_notification(){
        $template = EmailTemplate::all();
        return view('dashboard.email_templates.sendOfferNotification',compact('template'));
    }

    public function send_email_offer_notification(Request $request){
         $this->validate($request, [
            'role' => 'required',
            'emails' => 'required',
            'template' => 'required',
        ]);

        $template = $request->input('template');
        $to = $request->input('emails');
        $emailTemplateInfo = EmailTemplate::where('id',$template)->first();
        $subject = $emailTemplateInfo->subject;
        $message = $emailTemplateInfo->description;
        $send = Helper::send_email($to,$subject,$message);
        if($send == true){
            return Redirect::back()->with('success', 'Email Send Successfully');
        }else{
            return Redirect::back()->with('error', 'Something went wrong');
        }
    }
    public function getEmails($id){
        $userInfo = User::where('role',$id)->get();
        return response()->json($userInfo);
    }
}
