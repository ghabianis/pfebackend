<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Models\bookingss;
use Illuminate\Support\Facades\DB;

class booking extends Controller
{

public function MakeBreakBooking(Request $request){

        $data =$request->validate([
            'userId'=>'required|string|max:255',
            'email'=>'required|email|',
            'departement'=>'required',
            'chef'=>'required',
            'title'=>'required',
            'start'=>'required',
            'end'=>'required',
        ]);
        $user = bookingss::create([
            'userId' =>$data['userId'],
            'email'=>$data['email'],
            'departement'=>$data['departement'],
            'chef'=>$data['chef'],
            'title'=>$data['title'],
            'start'=>$data['start'],
            'end'=>$data['end'],

        ]);
        if($user){
            $username = bookingss::all();
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

public function getAllMakeBreakBooking(Request $request){
    $book = bookingss::all();
    return $book;
}

public function getMakeBreakBookingById(Request $request,$userId){
    $user = DB::table('bookings')
    ->where('userId','=', $userId)
    ->get();
    return response()->json($user);
}

public function AcceptBookings(Request $request,$id){
    $user = bookingss::where('id', '=', $id)->update(['status' => true]);
    if($user){
        $username = bookingss::all();
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

public function rejectBookings(Request $request,$id){
      $user = bookingss::where('id', '=', $id)->update(['reject' => true]);
      if($user){
        $username = bookingss::all();
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
public function getBreakBookingsCalanderInfo(Request $request,$userId){
        $user = DB::table('bookings')
        ->select('title','start', 'end')
        ->where('userId', '=', $userId)
        ->get();
        return $user;
}
}
