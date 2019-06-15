<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;

class CourseIsPrivateException extends Exception
{
    /**
     * Render the exception as an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function render($request)
    {
    	$data =  ['data'=>'course is private','status'=>'error'];
        return $request->expectsJson()
            ? new JsonResponse($data,401) : view('errors.courseisprivate');
    }
}
