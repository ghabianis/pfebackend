<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\forum;
use App\Models\relpy;
use Illuminate\Support\Facades\DB;
class forumController extends Controller
{
// add questions
     public function addQuestion(Request $request){
        $data =$request->validate([
            'userId'=>'required',
            'question'=>'required',
            'desc'=>'required',
            'tags'=>'required',
            'cat'=>'required',
            'likes'=>'unique:forums'
        ]);
        $question = forum::create([
            'userId'=>$data['userId'],
            'question' =>$data['question'],
            'desc' =>$data['desc'],
            'tags'=>$data['tags'],
            'cat'=>$data['cat']
        ]);
        return $question;
     }
// get questions
     public function getQuestions(Request $request){
        $question = forum::all();
        return $question;
     }
// add a reply
     public function relpyQuestion(Request $request,$id){
        $data =$request->validate([
            'rep'=>'required|string|max:255',
        ]);
        if($data){
            $questin = forum::where('id','=',$id)->increment('reply',1);
        }
        $relpy = relpy::create([
            'rep' =>$data['rep'],
        ]);
        return $relpy;
     }
    //  get replys
     public function getReplys(Request $request,$id){
        $question = relpy::where('id','=',$id)->get();
        return $question;
     }

     public function addLike(Request $request,$userId){
        $question = forum::where('userId','=',$userId)->increment('likes',1);
        return $question;
     }
}
