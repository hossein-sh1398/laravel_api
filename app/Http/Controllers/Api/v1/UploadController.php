<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\FileSystem\FileSystem;
use Verta;
class UploadController extends Controller
{
    public function image(Request $request,FileSystem $filesystem){
         
        $data= $this->validate($request,[
          'image'=>'required|max:10240',
        ]);
         $dt=new Verta();
         $file=$request->file('image');
        $name = "{$dt->year}{$dt->month}{$dt->day}{$dt->timestamp}.{$file->getClientOriginalExtension()}";

         $path="upload/image"; 
         if($filesystem->exists(public_path("{$path}/$name"))){
         	$name= "{$dt->timestamp}-{$name}";
         }
        $file->move(public_path($path), $name);
        return response([
           'data'=>['message'=>'با موفقیت آپلود شد'],
           'sattus'=>'success'
        ]);
         
    }
}
