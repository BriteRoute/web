<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          @if(Auth::User()->user_img != null || Auth::User()->user_img !='')
          <img src="{{ asset('images/user_img/'.Auth::User()->user_img)}}" class="img-circle" alt="User Image">

          @else
          <img src="{{ asset('images/default/user.jpg') }}" class="img-circle" alt="User Image">

          @endif
        </div>
        <div class="pull-left info">
          <p>{{ Auth::User()->fname }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> {{ __('adminstaticword.Instructor') }}</a>
        </div>
      </div>
 

      @if(Auth::User()->role == "instructor")
        <ul class="sidebar-menu" data-widget="tree">
          <li class="header">{{ __('adminstaticword.Navigation') }} </li>

          <li class="{{ Nav::isRoute('instructor.index') }}"><a href="{{route('instructor.index')}}"><i class="flaticon-web-browser" aria-hidden="true"></i><span>{{ __('adminstaticword.Dashboard') }}</span></a></li>
          
          <li class="{{ Nav::isResource('category') }} {{ Nav::isResource('subcategory') }} {{ Nav::isResource('childcategory') }} {{ Nav::isResource('course') }} {{ Nav::isResource('courselang') }} treeview">
            <a href="#">
                <i class="flaticon-browser-1"></i>{{ __('adminstaticword.Course') }}
                <i class="fa fa-angle-left pull-right"></i>
            </a>

            <ul class="treeview-menu">
              <li class="{{ Nav::isResource('category') }} {{ Nav::isResource('subcategory') }} {{ Nav::isResource('childcategory') }} {{ Nav::isResource('course') }} {{ Nav::isResource('courselang') }} {{ Nav::isRoute('assignment.view') }} treeview">
                 
                  @if($gsetting->cat_enable == 1)
                  <a href="#"><i class="flaticon-interface" aria-hidden="true"></i>{{ __('adminstaticword.Category') }}<i class="fa fa-angle-left pull-right"></i></a>
                  
                  <ul class="treeview-menu">
                    <li class="{{ Nav::isResource('category') }}"><a href="{{url('category')}}"><i class="flaticon-rec"></i>{{ __('adminstaticword.Category') }}</a></li>
                    <li class="{{ Nav::isResource('subcategory') }}"><a href="{{url('subcategory')}}"><i class="flaticon-rec"></i>{{ __('adminstaticword.SubCategory') }}</a></li>
                    <li class="{{ Nav::isResource('childcategory') }}"><a href="{{url('childcategory')}}"><i class="flaticon-rec"></i>{{ __('adminstaticword.ChildCategory') }}</a></li>
                  </ul>
                  @endif                           

                
                  <li class="{{ Nav::isResource('course') }}"><a href="{{url('course')}}"><i class="flaticon-document" aria-hidden="true"></i><span>{{ __('adminstaticword.Course') }}</span></a></li>


                  <li class="{{ Nav::isRoute('courses.reject') }}"><a href="{{route('courses.reject')}}"><i class="flaticon-document" aria-hidden="true"></i><span>{{ __('adminstaticword.RejectedCourses') }}</span></a></li>

                  <li class="{{ Nav::isResource('courselang') }}"><a href="{{url('courselang')}}"> <i class="flaticon-translation" aria-hidden="true"></i></i><span> {{ __('adminstaticword.Course') }} {{ __('adminstaticword.Language') }}</span></a></li>
                  
                  @if($gsetting->assignment_enable == 1)
                  <li class="{{ Nav::isRoute('assignment.view') }}"><a href="{{route('assignment.view')}}"><i class="flaticon-computer" aria-hidden="true"></i><span>{{ __('adminstaticword.Assignment') }}</span></a></li>
                  @endif
                 
                </li>
              </ul>
          </li>


          <li class="{{ Nav::isRoute('allrequestinvolve') }} {{ Nav::isRoute('involve.request.index') }} {{ Nav::isRoute('involve.request') }} treeview">
            <a href="#">
              <i class="flaticon-test" aria-hidden="true"></i> <span>{{ __('adminstaticword.MultipleInstructor') }}</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Nav::isRoute('allrequestinvolve') }}"><a href="{{route('allrequestinvolve')}}"> <i class="flaticon-pending"></i>{{ __('adminstaticword.RequestToInvolve') }}</a></li>
              <li class="{{ Nav::isRoute('involve.request.index') }}"><a href="{{route('involve.request.index')}}"><i class="flaticon-question" aria-hidden="true"></i>{{ __('adminstaticword.InvolvementRequests') }}</a></li>
               <li class="{{ Nav::isRoute('involve.request') }}"><a href="{{route('involve.request')}}"><i class="flaticon-web-browser" aria-hidden="true"></i>{{ __('adminstaticword.InvolvedInCourse') }}</a></li>
            </ul>
          </li>



          <li class="{{ Nav::isResource('userenroll') }}"><a href="{{url('userenroll')}}"><i class="flaticon-user" aria-hidden="true"></i><span> {{ __('adminstaticword.User') }} {{ __('adminstaticword.Enrolled') }}</span></a></li>


          <li class="{{ Nav::isResource('instructorquestion') }} {{ Nav::isResource('instructoranswer') }} treeview">
            <a href="#">
                <i class="flaticon-faq"></i> {{ __('adminstaticword.Question') }} / {{ __('adminstaticword.Answer') }}
                <i class="fa fa-angle-left pull-right"></i>
            </a>                            

            <ul class="treeview-menu">
              <li class="{{ Nav::isResource('instructorquestion') }}"><a href="{{url('instructorquestion')}}"><i class="flaticon-help" aria-hidden="true"></i><span>{{ __('adminstaticword.Question') }}</span></a></li>

              <li class="{{ Nav::isResource('instructoranswer') }}"><a href="{{url('instructoranswer')}}"><i class="flaticon-test" aria-hidden="true"></i><span>{{ __('adminstaticword.Answer') }}</span></a></li>
            </ul>
          </li>

          <li class="{{ Nav::isResource('instructor/announcement') }}"><a href="{{url('instructor/announcement')}}"><i class="flaticon-mobile-marketing" aria-hidden="true"></i><span>{{ __('adminstaticword.Announcement') }}</span></a></li>

          <li class="{{ Nav::isResource('blog') }}"><a href="{{url('blog')}}"><i class="flaticon-personal-information"></i>{{ __('adminstaticword.Blog') }}</a></li>

          
          
          @if(isset($gsetting->feature_amount))
          <li class="{{ Nav::isResource('featurecourse') }}"><a href="{{url('featurecourse')}}"><i class="flaticon-smartphone" aria-hidden="true"></i><span> {{ __('adminstaticword.Featured') }} {{ __('adminstaticword.Course') }}</span></a></li>
          @endif

          @if(isset($zoom_enable) && $zoom_enable == 1)
          <li class="{{ Nav::isRoute('meeting.create') }} {{ Nav::isRoute('zoom.show') }} {{ Nav::isRoute('zoom.edit') }} {{ Nav::isRoute('zoom.setting') }} {{ Nav::isRoute('zoom.index') }}  treeview">
            <a href="#">
             <i class="flaticon-live" aria-hidden="true"></i> <span>{{ __('Zoom Live Meetings') }}</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="{{ Nav::isRoute('zoom.setting') }}"><a href="{{route('zoom.setting')}}"><i class="flaticon-optimization"></i>{{ __('Zoom Settings') }}</a></li>
              <li class="{{ Nav::isRoute('zoom.index') }} {{ Nav::isRoute('zoom.show') }} {{ Nav::isRoute('zoom.edit') }} {{ Nav::isRoute('meeting.create') }}"><a href="{{route('zoom.index')}}"><i class="flaticon-layout"></i>{{ __('Zoom Dashboard') }}</a></li>
            </ul>
          </li>
       @endif

       @if(isset($gsetting) && $gsetting->bbl_enable == 1)
          <li class="{{ Nav::isRoute('bbl.all.meeting') }} treeview">
            <a href="#">
             <i class="flaticon-live-1" aria-hidden="true"></i> <span>{{ __('Big Blue Meetings') }}</span>
              <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              
              <li class="{{ Nav::isRoute('bbl.all.meeting') }}"><a href="{{ route('bbl.all.meeting') }}"><i class="flaticon-document-2"></i>{{ __('List Meetings') }}</a></li>
            </ul>
          </li>
       @endif


        @if(isset($gsetting) && $gsetting->jitsimeet_enable == 1)
            <li class="{{ Nav::isRoute('jitsi.dashboard') }} {{ Nav::isRoute('jitsi.create') }} treeview">
                <a href="#">
                 <i class="fa fa-sheqel" aria-hidden="true"></i> <span>{{ __('Jitsi Meeting') }}</span>
                  <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                  </span>
                </a>
                <ul class="treeview-menu">
                  <li class="{{ Nav::isRoute('jitsi.dashboard') }}"><a href="{{ route('jitsi.dashboard') }}"><i class="flaticon-settings-1"></i>{{ __('Dashboard') }}</a></li>
                  
                </ul>
              </li>
          @endif


          <li class="{{ Nav::isResource('pending.payout') }} {{ Nav::isRoute('admin.completed') }} treeview">
            <a href="#">
                <i class="flaticon-money-1"></i> {{ __('adminstaticword.MyRevenue') }}
                <i class="fa fa-angle-left pull-right"></i>
            </a>                            

            <ul class="treeview-menu">
              <li class="{{ Nav::isResource('pending.payout') }}"><a href="{{route('pending.payout')}}"><i class="flaticon-pending" aria-hidden="true"></i><span>{{ __('adminstaticword.PendingPayout') }}</span></a></li>

              <li class="{{ Nav::isRoute('admin.completed') }}"><a href="{{route('admin.completed')}}"><i class="flaticon-file"></i>{{ __('adminstaticword.CompletedPayout') }}</a></li>

            </ul>
          </li>

          @if(isset($isetting))

          <li class="{{ Nav::isResource('instructor.pay') }}"><a href="{{route('instructor.pay')}}"><i class="flaticon-settings-3" aria-hidden="true"></i><span>{{ __('adminstaticword.PayoutSettings') }}</span></a></li>

          @endif
          
          


        <ul>
      @endif


    </section>
    <!-- /.sidebar -->
</aside>