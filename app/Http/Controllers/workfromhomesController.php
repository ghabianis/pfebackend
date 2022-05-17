<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Models\workfromhomes;
use Illuminate\Support\Facades\DB;
class workfromhomesController extends Controller
{
    public function MakeWorkFromHomeBooking(Request $request){

        $data =$request->validate([
            'userId'=>'required|string|max:255',
            'email'=>'required|email|',
            'departement'=>'required',
            'chef'=>'required',
            'desc'=>'required',
            'start'=>'required',
            'end'=>'required',
        ]);
        $user = workfromhomes::create([
            'userId' =>$data['userId'],
            'email'=>$data['email'],
            'departement'=>$data['departement'],
            'chef'=>$data['chef'],
            'desc'=>$data['desc'],
            'start'=>$data['start'],
            'end'=>$data['end'],

        ]);
        if($user){
            $username = workfromhomes::all();
        //    return strval($username[0]->nom);
        // $email =
        $data = array('nom'=>strval($username[0]->nom));
        Mail::send('breakbooking', $data, function($message) use($username) {
           $message->to(strval($username[0]->email),'TEST') ->subject
              ('ASM HR TEAM');
           $message->from('anisghabi8@gmail.com','Ghabi Anis');
           return response( "HTML Email Sent. Check your inbox.");

        });
    }


  }

public function getAllWorkFromHomeBookings(Request $request){
    $book = workfromhomes::all();
    return $book;
}

public function getAllWorkFromHomeBookingsById(Request $request,$userId){
    $user = DB::table('workfromhomes')
    ->where('userId','=', $userId)
    ->get();
    return response()->json($user);
}

public function AcceptedWorkFromHomeBookings(Request $request,$id){
    $user = workfromhomes::where('id', '=', $id)->update(['status' => true]);
    if($user){
        $username = workfromhomes::all();
    //    return strval($username[0]->nom);
    // $email =
    $data = array('nom'=>strval($username[0]->nom));
    Mail::send('acceptedBookings', $data, function($message) use($username) {
       $message->to(strval($username[0]->email),'TEST') ->subject
          ('ASM HR TEAM');
       $message->from('anisghabi8@gmail.com','Ghabi Anis');
       return response( "HTML Email Sent. Check your inbox.");

    });
}
  }

public function RejectedWorkFromHomeBookings(Request $request,$id){
      $user = workfromhomes::where('id', '=', $id)->update(['reject' => true]);
      if($user){
        $username = workfromhomes::all();
    //    return strval($username[0]->nom);
    // $email =
    $data = array('nom'=>strval($username[0]->nom));
    Mail::send('breakbooking', $data, function($message) use($username) {
       $message->to(strval($username[0]->email),'TEST') ->subject
          ('ASM HR TEAM');
       $message->from('anisghabi8@gmail.com','Ghabi Anis');
       return response( "HTML Email Sent. Check your inbox.");

    });
}
    }
public function getWorkFromHomeBookingsForCalender(Request $request){
        $user = DB::table('workfromhomes')
        ->select('desc as title','start', 'end')
        ->get();
        return $user;
}
public function workFromHomeCalender(Request $request,$userId){
    $user = DB::table('workfromhomes')
    ->select('desc as title','start', 'end')
    ->where('userId', '=', $userId)
    ->get();
    return $user;
}
}
