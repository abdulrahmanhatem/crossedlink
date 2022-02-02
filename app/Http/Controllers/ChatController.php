<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Chat;
use App\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ChatReceiverNotfication;




class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $chats = Chat::where('sender_id', auth()->user()->id)->orWhere('reciever_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        $chats = Chat::where('sender_id', auth()->user()->id)->orWhere('reciever_id', auth()->user()->id)->orderBy('created_at', 'desc')->get();
        $chats = json_decode($chats, true);
        $chat_ids = [];
        
        if($chats){
        foreach ($chats as $chat) {
            if (auth()->user()->role == 1 || auth()->user()->role == 2) {
                
              if($chat['sender_id'] != auth()->user()->id ){
                  
                if (\Helper::unlockCheck($chat['sender_id'])) {
                    // dd(auth()->user()->role);
                    $user = User::find($chat['sender_id']);
                    if($user){
                        array_push($chat_ids, User::find($chat['id']) );
                    }
                }
              }
              if($chat['reciever_id'] != auth()->user()->id){
                  
                if (\Helper::unlockCheck($chat['reciever_id'])) {
                    $user = User::find($chat['reciever_id']);
                    if($user){
                        array_push($chat_ids, User::find($chat['id']) );
                    }
                }
              }
            }else{
              if($chat['sender_id'] != auth()->user()->id ){
                   $user = User::find($chat['sender_id']);
                    if($user){
                        array_push($chat_ids, User::find($chat['id']) );
                    }
              }
              if($chat['reciever_id'] != auth()->user()->id){
                    $user = User::find($chat['reciever_id']);
                    if($user){
                        array_push($chat_ids, User::find($chat['id']) );
                    }
              }
            }
          }
        }
        $chats = Chat::whereIn('id', $chat_ids)->orderBy('created_at', 'desc')->get();
        
        $data = array(
            'chats' => $chats, 
        );
        // dd($chats);
        // dd(\Helper::chatList());
        return view('chat.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('chat.create');
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
            "file" => "mimes:jpeg,png,jpg,gif,svg,doc,pdf,docx,zip|max:9999",
        ]);

        // Handle File Upload
        if($request->hasFile('file')){

            // Get Filename With Extension
            $filenameWithExt = $request->file('file')->getClientOriginalName();
            // Get Just Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get Just Extension
            $extension = $request->file('file')->getClientOriginalExtension();
            // Filename To Store
            $file = $filename.'_'.time().'.'.$extension;
            // Upload Image
            //$path = $request->file('profile_image')->storeAs('public/profile_image', $filenameToStore);
            $request->file('file')->move(base_path('/uploads/pdf/chat_pdf'), $file);
        }
        if($request->hasFile('file') || $request->has('text')){
            // Create Chat
            $chat = new Chat;
            $chat->sender_id = $request->input('sender_id');
            $chat->reciever_id = $request->input('reciever_id');
            if($request->hasFile('file')){
                $chat->file = $file;
            }else{
                $chat->file = '';
            }
            $chat->text = $request->input('text');
            $chat->save();
            
            // send notification to receiver
            
            $receiver = User::find($request->input('reciever_id'));

            Notification::send($receiver, new ChatReceiverNotfication(auth()->user()->id));
            
            return Redirect::back();
        }else{
            return Redirect::back();
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $chat = Chat::find($id);
        $data = array(
            'admin' => $chat
        );
        return view('chat.show')->with($data);
    }

    public function showByUser($id)
    {
        $chats = Chat::where([['sender_id', auth()->user()->id], ['reciever_id', $id]])->orWhere([['sender_id', $id], ['reciever_id', auth()->user()->id]])->get();
        $other = User::find($id);
        $data = array(
            'chats' => $chats,
            'other' => $other
        );
        if($other){
            if(auth()->user()->role == 1 || auth()->user()->role == 2 ){
                if (\Helper::unlockCheck($other->id)) {
                    return view('chat.show')->with($data);
                }else{
                    return Redirect::back();
                }
            }elseif(auth()->user()->role == 0){
                if (\Helper::chatListCheck($other->id)) {
                    return view('chat.show')->with($data);
                }else{
                    return Redirect::back();
                }
            }
        }else{
            return Redirect::back();
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $chat = Chat::find($id);
        $data = array(
            'admin' => $chat
        );
        return view('client.chats.edit')->with($data);
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
            'name' => 'required',
            'email' => 'required',
            'profile_image' => 'image|nullable|max:1999',
            'password' => 'min:6|required', 
            /*'password_confirmation' => 'min:6'*/
        ]);

        // Handle File Upload
        if($request->hasFile('profile_image')){

            // Get Filename With Extension
            $filenameWithExt = $request->file('profile_image')->getClientOriginalName();
            // Get Just Filename
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            // Get Just Extension
            $extension = $request->file('profile_image')->getClientOriginalExtension();
            // Filename To Store
            $profile_image = $filename.'_'.time().'.'.$extension;
            // Upload Image
            //$path = $request->file('profile_image')->storeAs('public/profile_image', $filenameToStore);
            $request->file('profile_image')->move(base_path('/uploads/images/profile_images'), $profile_image);
        }

        // Edit Admin
        $chat = Chat::find($id);
        $chat->company_name = $request->input('company_name');
        $chat->name = $request->input('name');
        $chat->password = bcrypt($request->input('password'));
        if($request->hasFile('profile_image')){
            $chat->profile_image = $profile_image;
        }
        $chat->email = $request->input('email');
        $chat->phone = $request->input('phone');
        $chat->address = $request->input('address');
        $chat->website = $request->input('website');
        $chat->save();
        return Redirect::back()->with('success', 'Admin Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Delete Admin
        $chat = Chat::find($id);

        $chat->delete();

        return Redirect::back();
    }

    public function download($id)
    {
        
        $chat = Chat::find($id);

        //PDF file is stored under project/public/download/info.pdf
        $file= base_path(). '/uploads/pdf/chat_pdf/'. $chat->file;

        $headers = array(
                'Content-Type: application/pdf',
                );

    return response()->download($file, $chat->file, $headers);
    }

}
