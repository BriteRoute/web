<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Assignment;
use Auth;
use App\Course;

class AssignmentController extends Controller
{
    public function submit(Request $request, $id) {


    	if($file = $request->file('assignment'))
        {
            $name = time().$file->getClientOriginalName();
            $file->move('files/assignment', $name);
            $input['assignment'] = $name;
        }

    	$assignment = Assignment::create([
                'user_id' => Auth::User()->id,
                'instructor_id' => $request->instructor_id,
                'course_id' => $id,
                'chapter_id' => $request->course_chapters,
                'title' => $request->title,
                'type' => 0,
                'assignment' => $name,
            ]
        );

        return back()->with('success',trans('flash.SubmittedSuccessfully')); 

    }

    public function index() 
    {
    	$assignment = Assignment::all();
        return view('admin.course.assignment.index', compact('assignment'));
    }

    public function show($id)
    {
        $assign = Assignment::find($id);
        return view('admin.course.assignment.view', compact('assign'));
    }

    public function update(Request $request, $id)
    {

        $data = Assignment::findorfail($id);
        $maincourse = Course::findorfail($request->course_id);
        $input['type'] = $request->type;
        

        if(isset($request->type))
        {
            Assignment::where('id', $id)
                    ->update(['rating' => $request->rating, 'type' => 1]);
        }
        else
        {
            Assignment::where('id', $id)
                    ->update(['rating' => NULL, 'type' => 0]);
        }

        return redirect()->route('list.assignment',$maincourse->id);

    }

    public function destroy($id)
    {

        $assign = Assignment::find($id);

        if($assign->assignment != null)
        {
                
            $image_file = @file_get_contents(public_path().'/files/assignment/'.$assign->assignment);

            if($image_file)
            {
                unlink(public_path().'/files/assignment/'.$assign->assignment);
            }
        }

        Assignment::where('id', $id)->delete();
        return back()->with('delete', trans('flash.DeletedSuccessfully'));
    }

    public function delete($id)
    {

        $assign = Assignment::find($id);

        if($assign->assignment != null)
        {
                
            $image_file = @file_get_contents(public_path().'/files/assignment/'.$assign->assignment);

            if($image_file)
            {
                unlink(public_path().'/files/assignment/'.$assign->assignment);
            }
        }

        Assignment::where('id', $id)->delete();
        return back()->with('delete',trans('flash.DeletedSuccessfully'));
    }


    public function view()
    {

        if(Auth::user()->role == "admin") 
        {
            $courses = Course::get();
        }
        else{
            $courses = Course::where('user_id', Auth::user()->id)->get();
        }
        
        return view('admin.course.assignment.course', compact('courses'));
    }


    public function assignment($id)
    {
        $assignment = Assignment::where('course_id', $id)->get();
        return view('admin.course.assignment.index', compact('assignment'));
    }


}
