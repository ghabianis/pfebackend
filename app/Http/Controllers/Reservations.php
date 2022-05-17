<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materil;
use App\Models\makeReservations;
use Mail;
use Illuminate\Support\Facades\DB;
class Reservations extends Controller
{
    public function getMaterial(Request $request){
        $data = Materil::all();
        return $data;
    }
    public function addMaterial(Request $request){
        $data = $request->validate([
            'name'=>'required',
            'type'=>'required',
           ]);
           $user = Materil::create(
            [
            'name' =>$data['name'],
            'type' =>$data['type'],
            ]
           );
               return $user;
    }
    public function AcceptReservations(Request $request,$userId){
        $data = makeReservations::where('userId','=',$userId)->update(['accept'=>true]);
        if($data){
            $username = makeReservations::all();
        //    return strval($username[0]->nom);
        // $email =
        $data = array('nom'=>strval($username[0]->nom));
        Mail::send('acceptedReservation', $data, function($message) use($username) {
           $message->to(strval($username[0]->email),'TEST') ->subject
              ('ASM HR TEAM');
           $message->from('anisghabi8@gmail.com','Ghabi Anis');
           return response( "HTML Email Sent. Check your inbox.");

        });
    }
    }
    public function RejectReservation(Request $request,$userId){
        $data = makeReservations::where('userId','=',$userId)->update(['reject'=>true]);
        if($data){
            $username = makeReservations::all();
        //    return strval($username[0]->nom);
        // $email =
        $data = array('nom'=>strval($username[0]->nom));
        Mail::send('rejectedReservation', $data, function($message) use($username) {
           $message->to(strval($username[0]->email),'TEST') ->subject
              ('ASM HR TEAM');
           $message->from('anisghabi8@gmail.com','Ghabi Anis');
           return response( "HTML Email Sent. Check your inbox.");

        });
    }
    }

    function makeReservation(Request $request){
        $data = $request->validate([
            'userId'=>'required|string|max:255|unique:make_reservations',
            'email'=>'required|email',
            'desk'=>'required',
            'screen'=>'string',
            'mouse'=>'string',
            'start'=>'date',
             'end'=>'date',
           ]);
           $res = makeReservations::create(
            [
            'userId' =>$data['userId'],
            'email' =>$data['email'],
            'desk' =>$data['desk'],
            'screen' =>$data['screen'],
            'mouse' =>$data['mouse'],
            'start' =>$data['start'],
            'end' =>$data['end'],
            ]
           );
           if($res){
            $username = makeReservations::all();
        //    return strval($username[0]->nom);
        // $email =
        $data = array('nom'=>strval($username[0]->nom));
        Mail::send('reservation', $data, function($message) use($username) {
           $message->to(strval($username[0]->email),'TEST') ->subject
              ('ASM HR TEAM');
           $message->from('anisghabi8@gmail.com','Ghabi Anis');
           return response( "HTML Email Sent. Check your inbox.");

        });
    }
    }
    function getAllReservations(Request $request){
        $res = makeReservations::all();
        return $res;
    }
    function getReservationsById(Request $request,$userId){
        $res = makeReservations::where('userId','=',$userId)->get();
        return $res;
    }
    function DeleteReservation(Request $request,$userId){
        $res = makeReservations::where('userId','=',$userId)->delete();
        if($res){
            $username = makeReservations::all();
        //    return strval($username[0]->nom);
        // $email =
        $data = array('nom'=>strval($username[0]->nom));
        Mail::send('deletedReservation', $data, function($message) use($username) {
           $message->to(strval($username[0]->email),'TEST') ->subject
              ('ASM HR TEAM');
           $message->from('anisghabi8@gmail.com','Ghabi Anis');
           return response( "HTML Email Sent. Check your inbox.");

        });
    }
    }

    public function updateReservations(Request $request,$userId){
        $user = DB::table('make_reservations')
        ->where('userId', $userId)
        ->where('accept',true)
        ->update([
            'start'=>$request->start,
            'end'=>$request->end,
            'accept'=>false
        ]);
        if($user){
            $username = makeReservations::all();
        //    return strval($username[0]->nom);
        // $email =
        $data = array('nom'=>strval($username[0]->nom));
        Mail::send('updateReservations', $data, function($message) use($username) {
           $message->to(strval($username[0]->email),'TEST') ->subject
              ('ASM HR TEAM');
           $message->from('anisghabi8@gmail.com','Ghabi Anis');
           return response( "HTML Email Sent. Check your inbox.");

        });
    }
     }

     public function getReservationsTime(Request $request,$userId){
        $user = DB::table('make_reservations')
        ->select('mouse as title','start', 'end')
        ->where('userId', '=', $userId)
        ->get();
        return $user;
        // $row = 0;
        //     $title = $user[$row]->title1.','.$user[$row]->title2.','.$user[$row]->title3;
        // return response()->json([
        //     "title"=>$title,
        //     "start"=>$user[0]->start,
        //     "end"=>$user[0]->end
        // ]);

     }
}



