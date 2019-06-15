<?php

namespace App\Http\Controllers\Api\v1;

use App\Exceptions\CourseIsPrivateException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Course;
use App\Http\Resources\v1\Course as CourseResourse;
use App\Http\Resources\v1\CourseCollection;
use Validator;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Requests\api\v1\CourseRequest;
class CourseController extends Controller
{
    public function index(){
    	$courses = Course::all();
    	return  new CourseCollection($courses);
    }

     public function single(Course $course){


         return new CourseResourse($course);

     }

     public function store(CourseRequest $request){
     	// $data = $request->all();
     	// $validator = Validator::make($data,[
      //    'title'=>['required','max:255','unique:courses'],
      //    'body'=>['required'],
     	// ]);
      
      //  if($validator->fails()){
       	
      //  return response()->json(['data'=>$validator->errors(),
      //  	'status'=>'error'], Response::HTTP_UNPROCESSABLE_ENTITY);
      
      //  }
     	//====================================================

     	// $this->validate($request, [
     	// 	'title'=>'required|max:255|unique:courses',
      //       'body'=>'required'
      //   ]);
        //==================================================
      
         // $course = new Course($request->all());
        
         // $course->save();
       return response([
        'data'=>'با موفقیت اضافه شد','status'=>'success'
       ],Response::HTTP_OK);
       
     }

    

}
