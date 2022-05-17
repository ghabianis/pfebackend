<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\DB;
use App\Models\reclamation;
use App\Models\todoModel;
use App\Models\userInfoModel;
use App\Models\reports;


use App\Http\Controllers\MailController;
use Mail;



class reclamationController extends Controller
{
      public function Reclamation(Request $request){

        $data =$request->validate([
            'userId'=>'required|string|max:255',
            'prenom'=>'required',
            'nom'=>'required|string|',
            'email'=>'required|email|',
            'departement'=>'required',
            'chef'=>'required',
            'cause'=>'required',
            'start'=>'required',
            'end'=>'required',
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
        return $user;
      }

      public function getReclamations(Request $request,$userId){
        $user = DB::table('reclamations')
        ->where('userId', $userId)
        ->get();
        return response()->json($user);
    }

    public function getAllReclamations(){
        $user = Reclamation::all();
        return $user;
    }

    public function updateStatus(Request $request,$id){
      $user = Reclamation::where('id', '=', $id)->update(['status' => true]);
      return $user;
    }

    public function updatereject(Request $request,$id){
        $user = Reclamation::where('id', '=', $id)->update(['reject' => true]);
        return $user;
      }

    public function deleteReclamation(Request $request,$userId){
        $user = DB::table('reclamations')
        ->where('userId', $userId)
        ->delete();

        return response()->json([
            'message'=> 'Deleted Successfully'
        ]);
    }
    public function getCalanderInfo(Request $request,$userId){
        $user = DB::table('reclamations')
        ->select('cause as title','start', 'end')
        ->where('status','=', true )
        ->where('userId', '=', $userId)
        ->get();
        return $user;
    }

    public function addToDOTask(Request $request){
        $data =$request->validate([
            'userId'=>'required|string|max:255|unique:todo_tasks',
            'title'=>'required',
            'jour'=>'required',
        ]);
        $user = todoModel::create([
            'userId' =>$data['userId'],
            'title' =>$data['title'],
            'jour' =>$data['jour'],
        ]);
        return response()->json($user);
    }
    public function getToDOTask(Request $request,$userId){
        $user = DB::table('todo_tasks')
        ->select('title','created_at as begin', 'jour as end','status')
        ->where('userId', '=', $userId)
        ->where('status', '=', false)
        ->get();
        return $user;
    }
    public function getAllToDOTask(Request $request){
        $user = todoModel::all();
        return $user;
    }
    public function updateTaskStatus(Request $request,$userId){
        $user = todoModel::where('userId', '=', $userId)->update(['status' => true]);
        return $user;
      }
      public function DeleteTask(Request $request,$userId){
        $user = todoModel::where('userId', '=', $userId);
        $user->Delete();
        return response()->json([
            'message'=>'Deleted Successfully'
        ]);
      }

    //   add user profile Info
    public function userProfileInfo(Request $request){
       $data = $request->validate([
        'userId'=>'required|string|max:255|unique:user_profile_infos',
        'name'=>'required',
        'education'=>'required|max:255|min:10|',
        'role'=>'required',
        'loc'=>'required',
        'skills'=>'required|max:255|min:10|',
        'notes'=>'max:255|min:10|',
       ]);
       $user = userInfoModel::create(
        [
        'userId' =>$data['userId'],
        'name' =>$data['name'],
        'education' =>$data['education'],
        'role' =>$data['role'],
        'loc' =>$data['loc'],
        'skills' =>$data['skills'],
        'notes' =>$data['notes'],
        ]
       );
           return $user;
    }
    public function  updatePorfileStatusInfo(Request $request,$userId){
        $user = userInfoModel::where('userId', '=', $userId)->update(['status' => true]);
        return $user;
    }

// update user profile info
      public function updateUserProfile(Request $request,$userId){
       if(
           $data = DB::table('user_profile_infos')
        ->where('userId', '=', $userId)
        ->update(
                  [
                     'name' => $request->name,
                     'education' => $request->education,
                     'role' => $request->role,
                     'loc' => $request->loc,
                     'skills' => $request->skills,
                     'notes' => $request->notes
                 ]
               )
           ){
                $user= userInfoModel::where('userId','=',$userId)->get();
                return response()->json([
                    'updated_Data'=>$user
                ]);
            }else{
               return response()->json([
                   'erreur'=>'update erreur'
               ]);
            }
      }
      function gettUserInfo(Request $request,$userId){
        $user=  userInfoModel::where('userId','=',$userId)->get();
        return $user;


      }


      public function makeReport(Request $request) {
        $data = $request->validate([
            'userId'=>'required',
            'department'=>'required',
            'problem'=>'required',
            'desc'=>'required|max:255|min:10|',
           ]);
           $user = reports::create(
            [
            'userId' =>$data['userId'],
            'department' =>$data['department'],
            'problem' =>$data['problem'],
            'desc' =>$data['desc'],
            ]
           );
               return $user;
     }
     public function getReports(Request $request,$userId){
        $user=  reports::where('userId','=',$userId)->get();
        return $user;
     }

     public function getAllReports(Request $request){
        $user=  reports::all();
        return $user;
     }

     public function updateReportsStatus(Request $request,$userId){
            $user = reports::where('userId', '=', $userId)->update(['status' => true]);
     }

     public function getReportsByStatus(Request $request,$userId){
        $user=  reports::where('userId', '=', $userId)
        ->where('status', '=', true)
        ->get();
        return $user;
     }
     public function deleteReports(Request $request,$id){
        $user=  reports::where('id', '=', $id)
        ->delete();
     }

     public function addSurvey(Request $request){
        $data = $request->validate([
            'userId'=>'required',
            'Survey'=>'required',
           ]);
           $user = reports::create(
            [
            'userId' =>$data['userId'],
            'Survey' =>$data['Survey'],
            ]
           );
               return $user;
     }

     public function updateReclamtion(Request $request,$userId){
        $user = DB::table('reclamations')
        ->where('userId', $userId)
        ->update([
            'title'=>$request->title,
            'start'=>$request->start,
            'end'=>$request->end,
        ]);
        return response()->json($user);
     }
}
