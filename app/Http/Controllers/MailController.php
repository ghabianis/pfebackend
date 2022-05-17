<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Mail;
use App\Models\reclamation;

use App\Http\Requests;
use App\Models\Announcments;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class MailController extends Controller {
   public function basic_email() {
      $data = array('name'=>"Virat Gandhi");

      Mail::send(['text'=>'mail'], $data, function($message) {
         $message->to('anisghabi8@gmail.com', 'Tutorials Point')->subject
            ('Laravel Basic Testing Mail');
         $message->from('anisghabi8@gmail.com','Virat Gandhi');
      });
      echo "Basic Email Sent. Check your inbox.";
   }
   public function html_email(Request $request) {
    $data =$request->validate([
        'userId'=>'required|string|max:255',
        'prenom'=>'required',
        'nom'=>'required|string|',
        'email'=>'required|email|',
        'departement'=>'required',
        'chef'=>'required',
        'cause'=>'required',
        'start'=>'required',
        'end'=>'required'
    ]);

    $user = reclamation::create([
        'userId' =>$data['userId'],
        'prenom' =>$data['prenom'],
        'nom'=>$data['nom'],
        'email'=>$data['email'],
        'departement'=>$data['departement'],
        'chef'=>$data['chef'],
        'cause'=>$data['cause'],
        'start'=>$data['start'],
        'end'=>$data['end'],

    ]);
    if($user){
        $username = reclamation::all();
    //    return strval($username[0]->nom);
    // $email =
    $data = array('nom'=>strval($username[0]->nom));
    Mail::send('mail', $data, function($message) use($username) {
       $message->to(strval($username[0]->email),'TEST') ->subject
          ('ASM HR TEAM');
       $message->from('anisghabi8@gmail.com','Ghabi Anis');
       return response( "HTML Email Sent. Check your inbox.");

    });
}

    //   $data = array('name'=>"Ghabi Anis");
    //   Mail::send('mail', $data, function($message) {
    //      $message->to('anisghabi8@gmail.com', 'User')->subject
    //         ('ASM HR TEAM');
    //      $message->from('anisghabi8@gmail.com','Ghabi Anis');
    //   });
    //   echo "HTML Email Sent. Check your inbox.";
   }
   public function attachment_email() {
      $data = array('name'=>"Virat Gandhi");
      Mail::send('mail', $data, function($message) {
         $message->to('anisghabi8@gmail.com', 'Tutorials Point')->subject
            ('Laravel Testing Mail with Attachment');
         $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
         $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
         $message->from('anisghabi8@gmail.com','Virat Gandhi');
      });
      echo "Email Sent with attachment. Check your inbox.";
   }

   public function testLogin(){

   }


   public function announcement(Request $request){
    $data =$request->validate([
        'title'=>'required',
        'content'=>'required|string',
    ]);

    $user = Announcments::create([
        'title' =>$data['title'],
        'content' =>$data['content'],
    ]);
     if($user){
         return $user;
     }
   }

   public function getAnnouncement(){
    $announcement = Announcments::all();
    return $announcement;
   }
   public function DeleteAnnouncement(Request $request,$id){
    $user = DB::table('announcments')
    ->where('id', $id)
    ->delete();
    return  response()->json([
        'message'=>'Deleted successfully'
    ]);
   }


}
