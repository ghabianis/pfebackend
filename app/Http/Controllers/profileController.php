<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\profileModel;
use App\Models\userInfoModel;
use App\Models\settings;
use Mail;
class profileController extends Controller
{

    public function AddProfileInfo(Request $request){

        $data =$request->validate([
            'userId'=>'required|string|max:255|unique:profiles',
            'nationality'=>'required',
            'childnb'=>'required|string|',
            'adress'=>'required',
            'email'=>'required',
            'favcol'=>'required',
            'fcblink'=>'required',
            'instlink'=>'required',
            'linkdlink'=>'required',
        ]);
        $user = userInfoModel::create([
            'userId' =>$data['userId'],
            'nationality' =>$data['nationality'],
            'childnb'=>$data['childnb'],
            'adress'=>$data['adress'],
            'email'=>$data['email'],
            'favcol'=>$data['favcol'],
            'fcblink'=>$data['fcblink'],
            'instlink'=>$data['instlink'],
            'linkdlink'=>$data['linkdlink'],
        ]);
        if($user){
            $username = userInfoModel::all();
        //    return strval($username[0]->nom);
        // $email =
        $data = array('nom'=>strval($username[0]->nom));
        Mail::send('addUserInfo', $data, function($message) use($username) {
           $message->to(strval($username[0]->email),'TEST') ->subject
              ('ASM HR TEAM');
           $message->from('anisghabi8@gmail.com','Ghabi Anis');
           return response( "HTML Email Sent. Check your inbox.");

        });
    }
    }
    public function getUserInfo(Request $request,$userId){
        $user = DB::table('user_profile_infos')
        ->where('userId', $userId)
        ->get();
        return response()->json($user);
    }
    public function getProfileUpdatedInfo(Request $request,$userId){
        $user = DB::table('user_profile_infos')
        ->where('userId', $userId)
        ->update([
            'nationality'=>$request->nationality,
            'childnb'=>$request->childnb,
            'adress'=>$request->adress,
            'favcol'=>$request->favcol,
            'fcblink'=>$request->fcblink,
            'instlink'=>$request->instlink,
            'linkdlink'=>$request->linkdlink,
        ]);
        if($user){
            $username = userInfoModel::all();
        //    return strval($username[0]->nom);
        // $email =
        $data = array('nom'=>strval($username[0]->nom));
        Mail::send('updatePorfileInfo', $data, function($message) use($username) {
           $message->to(strval($username[0]->email),'TEST') ->subject
              ('ASM HR TEAM');
           $message->from('anisghabi8@gmail.com','Ghabi Anis');
           return response( "HTML Email Sent. Check your inbox.");

        });
    }
    }

    public function MoreSettings(Request $request){

        $data =$request->validate([
            'userId'=>'required|string|max:255|unique:profiles',
            'fname'=>'required',
            'bday'=>'required|string|',
            'pname'=>'required',
            'mdate'=>'required',
        ]);
        $user = settings::create([
            'userId' =>$data['userId'],
            'fname' =>$data['fname'],
            'bday'=>$data['bday'],
            'pname'=>$data['pname'],
            'mdate'=>$data['mdate'],
        ]);
        return response()->json($user);
    }

   public function getExtraSettings(Request $request,$userId){
    $extra = settings::where('userId','=',$userId)->get();
    return $extra;
   }

}
