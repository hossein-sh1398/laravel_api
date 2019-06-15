<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{

   public function store(Request $request){
     $f=request()->validate(['title'=>'required','body'=>'required',]);
   	echo request('title').'<br>';
   	echo request('body').'<br>';




   }

    public function create(){
        return view('validate');
    }
    public function ajax(){
   	return request();
   }
}
