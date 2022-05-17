<?php

namespace App\Http\Controllers;
use App\Exceptions\InvalidOrderException;
use Illuminate\Http\Request;
use App\Models\training;
use App\Models\suscribedUsers;
use App\Models\externalCourse;

use Illuminate\Support\Str;
use Illuminate\Support\Collection;


class trainingController extends Controller
{
    public function addTraining(Request $request){
        $data =$request->validate([
            'userId'=>'required|string|max:255',
            't_name'=>'required',
            't_desc'=>'required|string|',
            'start'=>'required',
            'end'=>'required',
            'tech'=>'required'
        ]);
        $user = training::create([
            'userId' =>$data['userId'],
            't_name' =>$data['t_name'],
            't_desc'=>$data['t_desc'],
            'start'=>$data['start'],
            'end'=>$data['end'],
            'tech'=>$data['tech']
        ]);
        return $user;
    }
    public function getAllTraining(){
        $train = training::all();
        return $train;
    }
    public function getTrainingsById(Request $request,$id){
        $train = training::where("id","=",$id)->get();
        return $train;
    }

    public function AcceptTrainingRequest(Request $request,$id){
        $train = training::where("id","=",$id)->update(['accepted'=>true]);
        return $train;
    }
    public function RejectTrainingRequest(Request $request,$id){
        $train = training::where("id","=",$id)->update(['reject'=>true]);
        return $train;
    }
    public function addSubscription(Request $request){
            $data =$request->validate([
                'userId'=>'required|string|max:255|unique:suscribed_users',
                'username'=>'required',
                'userEmail'=>'required|string|email',
                'courseId'=>'required',
            ]);
            $user = suscribedUsers::create([
                'userId' =>$data['userId'],
                'username' =>$data['username'],
                'userEmail'=>$data['userEmail'],
                'courseId'=>$data['courseId'],
            ]);
            return $user;
    }

    public function subscribeTraining(Request $request,$id){
        $subUsers = suscribedUsers::select('courseId')->where("courseId","=",$id)->where('accepted',true)->value('courseId');
        $subnumber =  training::where("id",'=',$subUsers)->increment("subscriberNum",1);
        $train = training::where("id",'=',$subUsers)->update(['Subscriptionstatus'=>true]);
        return $train;
    }
    public function numberOfScubscribers(Request $request,$id){
        $subnumber =  training::where('tech','=','angular')->where('id',$id)->sum('subscriberNum');
        return $subnumber;
        // $subnumber =  training::where('tech','=','angular')->sum("t_name",'laravel');
        // $subnumber =  training::where('tech','=','angular')->sum("t_name",'php');
        // $subnumber =  training::where('tech','=','angular')->sum("t_name",'c-plus');
    }
    public function deleteTraining(Request $request,$id){
    $subnumber =  training::where("id",$id)->delete();
    return response()->json([
        'message'=>'Course deleted successfully'
    ]);
    }
    public function getAngularCourses(Request $request){
        $subnumber =  training::where("tech","angular")->get();
        return $subnumber;
     }

     public function getlaravelCourses(Request $request){
        $subnumber =  training::where("tech","laravel")->get();
        return $subnumber;
     }
     public function getreactCourses(Request $request){
        $subnumber =  training::where("tech","react")->get();
        return $subnumber;
     }
     public function getphpCourses(Request $request){
        $subnumber =  training::where("tech","php")->get();
        return $subnumber;
     }
     public function getcpulsCourses(Request $request){
        $subnumber =  training::where("tech","cpuls")->get();
        return $subnumber;
     }
     public function getcsharpCourses(Request $request){
        $subnumber =  training::where("tech","csharp")->get();
        return $subnumber;
     }
     public function getvueCourses(Request $request){
        $subnumber =  training::where("tech","vue")->get();
        return $subnumber;
     }
     public function getnodeCourses(Request $request){
        $subnumber =  training::where("tech","node")->get();
        return $subnumber;
     }


     public function getAllSubs(){
         $subs = suscribedUsers::all();
         return $subs;
     }

     public function getSubscriptionsBYId(Request $request,$userId){
        $subs = suscribedUsers::where('userId','=',$userId)->get();
        $su = $subs->count();
        $pp = (int)$su;
        $offers = collect();
        // return $pp;
        foreach($subs as $s){
            // echo 'hello there';
            // echo $i;
            $offers ->push(training::where("id",$s['courseId'])->get());
        }
        return $offers = $offers->flatten();
    }

    public function getAllSubscriptions(Request $request){
        $subs = suscribedUsers::all();
        $su = $subs->count();
        $pp = (int)$su;
        $offers = collect();
        // return $pp;
        foreach($subs as $s){
            // echo 'hello there';
            // echo $i;
            $offers ->push(training::where("id",$s['courseId'])->get());
        }
        return $offers = $offers->flatten();
    }
    public function ExternalCourseRequest(Request $request){
        $requ = externalCourse::create($request->all());
        return $requ;
    }

    public function getExternalCourses(Request $request,$userId){
        $requ = externalCourse::where('userId',$userId)->get();
        return $requ;
    }


    public function acceptRequest(Request $request,$id){
            $user = training::where('id', '=', $id)->update(['accepted' => true]);
            return $user;
    }
    public function rejectRequest(Request $request,$id){
        $user = training::where('id', '=', $id)->update(['rejected' => true]);
        return $user;
}

    public function acceptExteranlRequest(Request $request,$id){
      $user = externalCourse::where('id', '=', $id)->update(['accepted' => true]);
      return $user;
    }
   public function rejectExteranlRequest(Request $request,$id){
     $user = externalCourse::where('id', '=', $id)->update(['rejected' => true]);
     return $user;
   }
   public function getAllExternalRequests(Request $request){
    $user = externalCourse::all();
    return $user;
  }
}

