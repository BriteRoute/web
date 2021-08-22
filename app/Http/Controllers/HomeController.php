<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Categories;
use App\Slider;
use App\SliderFacts;
use App\CategorySlider;
use App\Course;
use App\Meeting;
use App\BBL;
use App\BundleCourse;
use App\Testimonial;
use App\Trusted;
use App\Order;
use Auth;
use Session;
use App\Blog;
use App\Batch;
use Illuminate\Support\Facades\Schema;
use App\Setting;
use App\Advertisement;
use App\Googlemeet;
use App\JitsiMeeting;
use Illuminate\Support\Facades\Cookie;
use Response;
use Config;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware(['auth','verified']);
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $category = Categories::orderBy('position','ASC')->get();
        $sliders = Slider::orderBy('position', 'ASC')->get();
        $facts = SliderFacts::limit(3)->get();
        $categories = CategorySlider::first();
        $cor = Course::all();
        $meetings = Meeting::where('link_by', NULL)->get();
        $bigblue = BBL::where('is_ended','!=',1)->where('link_by', NULL)->get();
        $testi = Testimonial::all();
        $trusted = Trusted::all();

        $blogs = Blog::where('status', '1')->orderBy('updated_at','DESC')->get();

        if(Schema::hasTable('googlemeets')){

            $allgooglemeet = Googlemeet::orderBy('id', 'DESC')->where('link_by', NULL)->get();
        }
        else{
            
            $allgooglemeet = NULL;
        }

        if(Schema::hasTable('jitsimeetings')){

            $jitsimeeting = JitsiMeeting::orderBy('id', 'DESC')->where('link_by', NULL)->get();

        }
        else{
            
            $jitsimeeting = NULL;
        }



        if (Schema::hasColumn('bundle_courses', 'is_subscription_enabled'))
        {
            $bundles = BundleCourse::where('is_subscription_enabled', 0)->get();
            $subscriptionBundles = BundleCourse::where('is_subscription_enabled', 1)->get();
        }
        else{

            $bundles = NULL;
            $subscriptionBundles = NULL;

        }
        

        if(Schema::hasTable('batch')){
            $batches = Batch::where('status', '1')->get();
        }
        else{
            $batches = NULL;
        }

        if(Schema::hasTable('advertisements')){
            $advs = Advertisement::where('status','=',1)->get();
        }
        else{
            $advs = NULL;
        }
        
        $viewed = session()->get('courses.recently_viewed');

        if(isset($viewed))
        {
           $recent_course_id = array_unique($viewed); 
        }
        else{

            $recent_course_id = NULL;

        }


        $counter = 0;
        $recent_course = NULL;

        if(Auth::check())
        {
            if( isset($recent_course_id) )
            {
                foreach ($recent_course_id as $item) {

                     $recent_course = Course::where('id', $item)->where('status', '1')->first();

                    if(isset($recent_course))
                    {
                        $counter++;
                    }
                }

            }
            

        }
        


         $total_count=$counter;

        return view('home', compact('category', 'sliders', 'facts', 'categories', 'cor', 'bundles', 'meetings', 'bigblue', 'testi', 'trusted', 'recent_course_id', 'blogs', 'subscriptionBundles', 'batches', 'recent_course', 'total_count', 'advs', 'allgooglemeet','jitsimeeting'));
    }
}
