<?php

namespace App\Http\Controllers;

use App\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use Image;
use App\CourseInclude;
use App\WhatLearn;
use App\CourseChapter;
use App\RelatedCourse;
use App\CourseClass;
use App\Categories;
use App\User;
use App\Wishlist;
use App\ReviewRating;
use App\Question;
use App\Announcement;
use App\Order;
use App\Answer;
use App\Cart;
use App\ReportReview;
use App\SubCategory;
use Session;
use App\QuizTopic;
use App\Quiz;
use Auth;
use Redirect;
use App\BundleCourse;
use App\CourseProgress;
use App\Adsense;
use App\Assignment;
use App\Appointment;
use App\BBL;
use App\Meeting;
use App\Currency;
use Cookie;
use Artesaos\SEOTools\Facades\SEOTools;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use App\PlanSubscribe;
use App\Setting;
use App\Googlemeet;
use App\JitsiMeeting;
use App\PreviousPaper;
use App\PrivateCourse;


class CourseController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $course = Course::all();
        $coursechapter = CourseChapter::all();

        $gsettings = Setting::first();
           
        return view('admin.course.index',compact("course",'coursechapter', 'gsettings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create()
    {
        $category = Categories::all();
        
        $course = Course::all();
        $coursechapter = CourseChapter::all();

        if(Auth::user()->role == 'admin'){
          $users =  User::where('id', '!=', Auth::user()->id)->where('role', '!=', 'user')->get();
        }
        else{
          $users =  User::where('id', Auth::user()->id)->first();
        }
        
        return view('admin.course.insert',compact("course",'coursechapter','category','users')); 
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {


        $this->validate($request,[
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'title' => 'required',
            'short_detail' => 'required',
            'detail' => 'required',
            'video' => 'mimes:mp4,avi,wmv',
            'slug' => 'required|unique:courses,slug',
        ]);

        $input = $request->all();

        $data = Course::create($input); 

        if(isset($request->type))
        {
          $data->type = "1";
        }
        else
        {
          $data->type = "0";
        }


        if($file = $request->file('preview_image')) 
        {        
          $optimizeImage = Image::make($file);
          $optimizePath = public_path().'/images/course/';
          $image = time().$file->getClientOriginalName();
          $optimizeImage->save($optimizePath.$image, 72);

          $data->preview_image = $image;
          
        }

        $data->drip_enable = isset($request->drip_enable)  ? 1 : 0;


        if(isset($request->preview_type))
        {
          $data->preview_type = "video";
        }
        else
        {
          $data->preview_type = "url";
        }

        if(isset($request->duration_type))
        {
          $data->duration_type = "m";
        }
        else
        {
          $data->duration_type = "d";
        }

        if(isset($request->involvement_request))
        {
          $data->involvement_request = "1";
        }
        else
        {
          $data->involvement_request = "0";
        }

        if(isset($request->assignment_enable))
        {
          $data->assignment_enable = "1";
        }
        else
        {
          $data->assignment_enable = "0";
        }

        if(isset($request->appointment_enable))
        {
          $data->appointment_enable = "1";
        }
        else
        {
          $data->appointment_enable = "0";
        }

        if(isset($request->certificate_enable))
        {
          $data->certificate_enable = "1";
        }
        else
        {
          $data->certificate_enable = "0";
        }

                    
        if(!isset($request->preview_type))
        {
            $data->url = $request->url;
        }
        else if($request->preview_type )
        {
            if($file = $request->file('video'))
            {
                
              $filename = time().$file->getClientOriginalName();
              $file->move('video/preview',$filename);
              $data->video = $filename;
            }
        }
        

        $data->save();

        return redirect('course');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\course  $course
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $instructor_course = Course::where('id', $id)->where('user_id', Auth::user()->id)->first();
        
        if(Auth::user()->role != "instructor" && Auth::user()->role != "user"){
            
            if(!isset($instructor_course))
            {
                 abort(404, 'Page Not Found.');
            }
        }
        
        $cor = Course::find($id);

        

        return view('admin.course.editcor',compact('cor'));
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\course  $course
     * @return \Illuminate\Http\Response
     */

    public function edit(course $course)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\course  $course
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {

        $request->validate([
          'title' => 'required',
          'video' => 'mimes:mp4,avi,wmv'

        ]);

          
        $course = Course::findOrFail($id);
        $input = $request->all();
           
        

        if(isset($request->type))
        {
          $input['type'] = "1";
        }
        else
        {
          $input['type'] = "0";
        }

        
        if ($file = $request->file('image')) {
          
          if($course->preview_image != null) {
            $content = @file_get_contents(public_path().'/images/course/'.$course->preview_image);
            if ($content) {
              unlink(public_path().'/images/course/'.$course->preview_image);
            }
          }

          $optimizeImage = Image::make($file);
          $optimizePath = public_path().'/images/course/';
          $image = time().$file->getClientOriginalName();
          $optimizeImage->save($optimizePath.$image, 72);

          $input['preview_image'] = $image;
          
        }

        $input['drip_enable'] = isset($request->drip_enable)  ? 1 : 0;


        if(isset($request->preview_type))
        {
          $input['preview_type'] = "video";
        }
        else
        {
          $input['preview_type'] = "url";
        }

        if(isset($request->duration_type))
        {
          $input['duration_type'] = "m";
        }
        else
        {
          $input['duration_type'] = "d";
        }

        if(isset($request->involvement_request))
        {
          $input['involvement_request'] = "1";
        }
        else
        {
          $input['involvement_request'] = "0";
        }

        if(isset($request->assignment_enable))
        {
          $input['assignment_enable'] = "1";
        }
        else
        {
          $input['assignment_enable'] = "0";
        }

        if(isset($request->appointment_enable))
        {
          $input['appointment_enable'] = "1";
        }
        else
        {
          $input['appointment_enable'] = "0";
        }

        if(isset($request->certificate_enable))
        {
          $input['certificate_enable'] = "1";
        }
        else
        {
          $input['certificate_enable'] = "0";
        }

        
        if(!isset($request->preview_type))
        {
            $course->url = $request->video_url;
            $course->video = null;
            
        }
        else if($request->preview_type )
        {
            if($file = $request->file('video'))
            {
              if($course->video != "")
              {
                $content = @file_get_contents(public_path().'/video/preview/'.$course->video);
                if ($content) {
                  unlink(public_path().'/video/preview/'.$course->video);
                }
              }
              
              $filename = time().$file->getClientOriginalName();
              $file->move('video/preview',$filename);
              $input['video'] = $filename;
              $course->url = null;

            }
        }

       

        Cart::where('course_id', $id)
         ->update([
             'price' => $request->price,
             'offer_price' => $request->discount_price,
          ]);


        $course->update($input);

        Session::flash('success',trans('flash.UpdatedSuccessfully'));
        return redirect('course');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\course  $course
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

      if(Auth::user()->role == "admin")
      {

        $order = Order::where('course_id', $id)->get();

        if(config('app.demolock') == 0){

          if(!$order->isEmpty())
          {
            return back()->with('delete',trans('flash.CannotDelete') );
          }
          else{
            
            $course = Course::find($id);
            
            if ($course->preview_image != null)
            {
                    
                $image_file = @file_get_contents(public_path().'/images/course/'.$course->preview_image);

                if($image_file)
                {
                    unlink(public_path().'/images/course/'.$course->preview_image);
                }
            }
            if ($course->video != null)
            {
                    
                $video_file = @file_get_contents(public_path().'/video/preview/'.$course->video);

                if($video_file != null)
                {
                    unlink(public_path().'/video/preview/'.$course->video);
                }
            }

            $value = $course->delete();


            Wishlist::where('course_id', $id)->delete();
            Cart::where('course_id', $id)->delete();
            ReviewRating::where('course_id', $id)->delete();
            Question::where('course_id', $id)->delete();
            Answer::where('course_id', $id)->delete();
            Announcement::where('course_id', $id)->delete();
            CourseInclude::where('course_id', $id)->delete();
            WhatLearn::where('course_id', $id)->delete();
            CourseChapter::where('course_id', $id)->delete();
            RelatedCourse::where('course_id', $id)->delete();
            CourseClass::where('course_id', $id)->delete();
            
            return back()->with('delete',trans('flash.DeletedSuccessfully'));
          }
        }
        else
        {
          return back()->with('delete',trans('flash.DemoCannotdelete'));
        }
      }

      return back()->with('delete','You cannot delete course');

    }

    public function upload_info(Request $request) 
    {

        $id = $request['catId'];
        $category = Categories::findOrFail($id);
        $upload = $category->subcategory->where('category_id',$id)->pluck('title','id')->all();

        return response()->json($upload);
    }


    public function gcato(Request $request) 
    {

      $id = $request['catId'];

      $subcategory = SubCategory::findOrFail($id);
      $upload = $subcategory->childcategory->where('subcategory_id',$id)->pluck('title','id')->all();

      return response()->json($upload);
    }

    public function showCourse($id)
    {   
        $course = Course::all();
        
        $cor = Course::findOrFail($id);

        if(Auth::user()->role == 'admin'){
          $users =  User::where('role', '!=', 'user')->get();
        }
        else{
          $users =  User::where('id', Auth::user()->id)->first();
        }
        
       
        $courseinclude = CourseInclude::where('course_id','=',$id)->orderBy('id','ASC')->get();
        $coursechapter = CourseChapter::where('course_id','=',$id)->orderBy('id','ASC')->get();
        $whatlearns = WhatLearn::where('course_id','=',$id)->orderBy('id','ASC')->get();
        $coursechapters = CourseChapter::where('course_id','=',$id)->orderBy('id','ASC')->get();
        $relatedcourse = RelatedCourse::where('main_course_id','=',$id)->orderBy('id','ASC')->get();
        $courseclass = CourseClass::where('course_id','=',$id)->orderBy('position','ASC')->get();
        $announsments = Announcement::where('course_id','=',$id)->get();
        $reports = ReportReview::where('course_id','=',$id)->get();
        $questions = Question::where('course_id','=',$id)->get();
        $answers = Answer::where('course_id','=',$id)->get();
        $quizes = Quiz::where('course_id','=',$id)->get();
        $topics = QuizTopic::where('course_id','=',$id)->get();
        $appointment = Appointment::where('course_id','=',$id)->get();

        $papers = PreviousPaper::where('course_id','=',$id)->get();

        return view('admin.course.show',compact('cor','course','courseinclude','whatlearns','coursechapters','coursechapter','relatedcourse','courseclass', 'announsments', 'answers', 'reports', 'questions', 'quizes', 'topics', 'appointment', 'papers', 'users' ));
    }



    public function CourseDetailPage($id, $slug)
    {
        
      $course = Course::findOrFail($id);

      session()->push('courses.recently_viewed', $id);

       
      $courseinclude = CourseInclude::where('course_id','=',$id)->orderBy('id','ASC')->get();
      $whatlearns = WhatLearn::where('course_id','=',$id)->orderBy('id','ASC')->get();
      $coursechapters = CourseChapter::where('course_id','=',$id)->orderBy('id','ASC')->get();
      $relatedcourse = RelatedCourse::where('main_course_id','=',$id)->get();
      $coursereviews = ReviewRating::where('course_id','=',$id)->get();
      $courseclass = CourseClass::orderBy('position','ASC')->get();
      $reviews = ReviewRating::where('course_id','=',$id)->get();
      $bundle_check = BundleCourse::first();

      $currency = Currency::first();

      $bigblue = BBL::where('course_id','=',$id)->get();

      $meetings = Meeting::where('course_id','=',$id)->get();
      $googlemeetmeetings = Googlemeet::where('course_id','=',$id)->get();
      $jitsimeetings = JitsiMeeting::where('course_id','=',$id)->get();

      $ad = Adsense::first();


      
      
      

        if(Auth::check())
        {
            
            $private_courses = PrivateCourse::where('course_id','=',$id)->first();
      
              if(isset($private_courses))
              {
                 $user_id = array();
                array_push($user_id, $private_courses->user_id);
                $user_id = array_values(array_filter($user_id));
                $user_id = array_flatten($user_id);
                
                if(in_array(Auth::user()->id, $user_id)){
        
                    return back()->with('delete', trans('flash.UnauthorizedAction'));
                }
                
                  
              }
              
          $order = Order::where('refunded', '0')->where('status', '1')->where('user_id', Auth::User()->id)->where('course_id', $id)->first();
          $wish = Wishlist::where('user_id', Auth::User()->id)->where('course_id', $id)->first();
          $cart = Cart::where('user_id', Auth::User()->id)->where('course_id', $id)->first();
          $instruct_course = Course::where('id','=',$id)->where('user_id','=',Auth::user()->id)->first();

          if(!empty($bundle_check))
          {

            if(Auth::user()->role == 'user')
            {
              $bundle = Order::where('user_id', Auth::User()->id)->where('bundle_id', '!=', NULL)->get();

              $course_id = array();
              

              foreach($bundle as $b)
              {
                 $bundle = BundleCourse::where('id', $b->bundle_id)->first();
                  array_push($course_id, $bundle->course_id);
              }

              $course_id = array_values(array_filter($course_id));

              $course_id = array_flatten($course_id);

              return view('front.course_detail',compact('course','courseinclude','whatlearns','coursechapters','courseclass', 'coursereviews', 'reviews', 'relatedcourse', 'course_id', 'ad', 'bigblue', 'meetings', 'googlemeetmeetings', 'jitsimeetings', 'order', 'wish', 'currency', 'cart', 'instruct_course'));
            }
            else
            {
              return view('front.course_detail',compact('course','courseinclude','whatlearns','coursechapters','courseclass', 'coursereviews', 'reviews', 'relatedcourse', 'ad', 'bigblue', 'meetings', 'googlemeetmeetings', 'jitsimeetings', 'order', 'wish', 'currency', 'cart', 'instruct_course'));
            }
          }
          else{

            return view('front.course_detail',compact('course','courseinclude','whatlearns','coursechapters','courseclass', 'coursereviews', 'reviews', 'relatedcourse', 'ad', 'bigblue', 'meetings', 'googlemeetmeetings', 'jitsimeetings', 'order', 'wish', 'currency', 'cart', 'instruct_course'));

          }
        }
        else
        {
          return view('front.course_detail',compact('course','courseinclude','whatlearns','coursechapters','courseclass', 'coursereviews', 'reviews', 'relatedcourse', 'ad', 'bigblue', 'meetings', 'googlemeetmeetings', 'jitsimeetings', 'currency'));
        }

      
      

    }

    public function CourseContentPage($id, $slug)
    { 
      $course = Course::where('id', $id)->first();
       
      $courseinclude = CourseInclude::where('course_id','=',$id)->orderBy('id','ASC')->get();
      $whatlearns = WhatLearn::where('course_id','=',$id)->orderBy('id','ASC')->get();
      $coursechapters = CourseChapter::where('course_id','=',$id)->orderBy('id','ASC')->get();
      $coursequestions = Question::where('course_id','=',$id)->get();
      $courseclass= CourseClass::get();
      $announsments = Announcement::where('course_id','=',$id)->get();

      $bigblue = BBL::where('course_id','=',$id)->get();

      $meetings = Meeting::where('course_id','=',$id)->get();
      $googlemeetmeetings = Googlemeet::where('course_id','=',$id)->get();
      $jitsimeetings = JitsiMeeting::where('course_id','=',$id)->get();

      $papers = PreviousPaper::where('course_id','=',$id)->get();


      if(Auth::check())
      {

        $progress = CourseProgress::where('course_id','=',$id)->where('user_id', Auth::User()->id)->first();

        $assignment = Assignment::where('course_id','=',$id)->where('user_id', Auth::User()->id)->get();

        $appointment = Appointment::where('course_id','=',$id)->where('user_id', Auth::User()->id)->get();
      
        return view('front.course_content',compact('course','courseinclude','whatlearns','coursechapters','courseclass', 'coursequestions', 'announsments', 'progress', 'assignment', 'appointment', 'bigblue', 'meetings', 'googlemeetmeetings', 'jitsimeetings', 'papers'));
      }
     
      return Redirect::route('login')->withInput()->with('delete', trans('flash.PleaseLogin')); 
     

    }

    public function mycoursepage()
    {
      if(Auth::check())
      {
        $course = Course::all();
        $enroll = Order::where('refunded', '0')->where('status', '1')->where('user_id', Auth::user()->id)->get();
      
        return view('front.my_course',compact('course', 'enroll'));
      }
     
      return Redirect::route('login')->withInput()->with('delete', trans('flash.PleaseLogin'));
    }
       
}
