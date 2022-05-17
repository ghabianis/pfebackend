<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\reportModel;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\DB;
use App\Models\todoModel;
use App\Models\Departement;
class UserController extends Controller
{
    public function register(Request $request){
       $data =$request->validate([
           'userId'=>'required|string|max:255|unique:users',
           'name'=>'required',
           'email'=>'required|string|email|max:255|unique:users',
           'password'=>'required','string',
       ]);
       $user = User::create([
           'userId' =>$data['userId'],
           'name' =>$data['name'],
           'email'=>$data['email'],
           'password'=>Hash::make($data['password'])
       ]);
       return response()->json($user);
    }

    public function check(Request $request,$userId){
        $user = DB::table('users')
        ->where('userId', $userId)
        ->get();
        return response()->json($user);
    }

    public function logout(Request $request){
        Auth::user()->tokens()->delete();
        return [
            'message' => 'logged out'
        ];

    }


    public function login(Request $request){
        $data =$request->validate([
            'email'=>'required|string|email|max:255',
            'password'=>'required','string',
        ]);
        $user = User::where('email',$data['email'])->first();
        if(!$user || !Hash::check($data['password'], $user->password)){
          return response(['message'=>'Invalid Credentials'],401);
        }else{
            $token = $user->createToken('loginTOken')->plainTextToken;
            $response = [
                'user'=>$user,
                'token'=>$token
            ];
            return response($response,200);
        }
     }

     public function reportUser(Request $request){
        $report = reportModel::create([
            "email"=>$request->email
        ]);
        return response()->json([
            "Message"=>"Your report has been Saved"
        ]);
     }
     public function AddTask(Request $request){
         $task = todoModel::create([
            "userId"=>$request->userId,
            "title"=>$request->title,
            "content"=>$request->content,
            "start"=>$request->start,
            "end"=>$request->end
        ]);
        return response()->json([
            "Message"=>"Your Task has been Saved"
        ]);
     }
     public function getAllTask(Request $request){
         $task = todoModel::all();
         return $task;
     }
     public function getTaskById(Request $request,$userId){
        $task = todoModel::where('userId','=',$userId)->get();
        return $task;
    }
     public function updateTaskActiveStatus(Request $request,$id){
        $task = todoModel::where('id','=',$id)->update(['active' => true,'completed' => false,'paused' => false]);
     }
     public function updateTaskPausedStatus(Request $request,$id){
       $task = todoModel::where('id','=',$id)->update(['paused' => true,'active' => false,'completed' => false]);
    }
    public function updateTaskCompletedStatus(Request $request,$id){
        $task = todoModel::where('id','=',$id)->update(['completed' => true,'paused' => false,'active' => false]);
     }
     public function getTaskEvent(Request $request){
        $task =  DB::table('todo_tasks')
        ->select('title','start', 'end')
        ->get();
        return $task;
     }
     public function DeleteTask(Request $request,$id){
        $user = todoModel::where('id', '=', $id);
        $user->Delete();
     }


    public function addepartement(Request $request){
        $data =$request->validate([
            'depart_name'=>'required|string',
            'chef'=>'required|string',
        ]);
        $app = Departement::create([
            'depart_name' =>$data['depart_name'],
            'chef' =>$data['chef'],
        ]);
        return response()->json($app);
     }
     public function getAllDepartements(Request $request){
        $app = Departement::all();
        return $app;
     }

}
