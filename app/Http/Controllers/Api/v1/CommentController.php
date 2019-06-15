<?php

namespace App\Http\Controllers\api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Comment;
class CommentController extends Controller
{
     public function store(Request $request){

        $this->validate($request,['body'=>'required']);

        $comment = new Comment($request->only('body'));
        auth()->user()->comments()->save($comment);
        return response(['data'=>'نظر شما با موفقیت ارسال شد','status'=>'success']);
     }
}
