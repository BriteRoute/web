<footer id="footer" class="footer-main-block">
    <div class="container">
        <div class="footer-block">
            <div class="row">
                @php
                    $widgets = App\WidgetSetting::first();
                @endphp
                <div class="col-lg-4 col-md-6 col-12">
                   
                    <div class="footer-logo">
                        @if($gsetting->logo_type == 'L')
                            @if($gsetting->footer_logo != NULL)
                            <a href="{{ url('/') }}" title="logo"><img src="{{ asset('images/logo/'.$gsetting->footer_logo) }}" alt="logo" class="img-fluid" ></a>
                            @endif
                        @else()
                            <a href="{{ url('/') }}"><b>{{ $gsetting->project_title }}</b></a>
                        @endif
                    </div>

                    

                    <div class="mobile-btn">
                        @if($gsetting->play_download == '1')
                            <a href="{{ $gsetting->play_link }}" title=""><img src="{{ url('images/icons/download-google-play.png') }}" alt="logo"></a>
                        @endif
                        @if($gsetting->app_download == '1')
                            <a href="{{ $gsetting->app_link }}" title=""><img src="{{ url('images/icons/app-download-ios.png') }}" alt="logo"></a>
                        @endif
                    </div>


                </div>
                @if(isset($widgets) && $widgets->widget_enable == 1)

                <div class="col-lg-2 col-md-6 col-4">
                    <div class="widget"><b>{{ $widgets->widget_one }}</b></div>
                    <div class="footer-link">
                        <ul>
                            @if($gsetting->instructor_enable == 1)
                                @if(Auth::check())
                                    @if(Auth::User()->role == "user")
                                    <li><a href="#" data-toggle="modal" data-target="#myModalinstructor" title="Become An Instructor">{{ __('frontstaticword.BecomeAnInstructor') }}</a></li>
                                    @endif
                                @else
                                    <li><a href="{{ route('login') }}" title="Become an instructor">{{ __('frontstaticword.BecomeAnInstructor') }}</a></li>
                                @endif
                            @endif

                            @if(isset($widgets) && $widgets->about_enable == 1)
                            <li><a href="{{ route('about.show') }}" title="About Us">{{ __('frontstaticword.Aboutus') }}</a></li>
                            @endif
                            
                            @if(isset($widgets) && $widgets->contact_enable == 1)
                            <li><a href="{{url('user_contact')}}" title="Contact Us">{{ __('frontstaticword.Contactus') }}</a></li>
                            @endif
                            
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-4">
                    <div class="widget"><b>{{ $widgets->widget_two }}</b></div>
                    <div class="footer-link">
                        <ul>
                            @if(isset($widgets) && $widgets->career_enable == 1)
                            <li><a href="{{ route('careers.show') }}" title="Careers">{{ __('frontstaticword.Careers') }}</a></li>
                            @endif

                            @if(isset($widgets) && $widgets->blog_enable == 1)
                            <li><a href="{{ route('blog.all') }}" title="Blog">{{ __('frontstaticword.Blog') }}</a></li>
                            @endif

                            @if(isset($widgets) && $widgets->help_enable == 1)
                            <li><a href="{{ route('help.show') }}" title="Help">{{ __('frontstaticword.Help&Support') }}</a></li>
                            @endif
                            
                        </ul>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 col-4">
                    <div class="widget"><b>{{ $widgets->widget_three }}</b></div>
                    <div class="footer-link">
                        <ul>
                            
                            @php
                                $pages = App\Page::get();
                            @endphp
                            
                            @if(isset($pages))
                            @foreach($pages as $page)
                                @if($page->status == 1)
                                <li><a href="{{ route('page.show', $page->slug) }}" title="{{ $page->title }}">{{ $page->title }}</a></li>
                                @endif
                            @endforeach
                            @endif
                            
                        </ul>
                    </div>
                </div>

                <div class="col-lg-2 col-md-6">

                    @php
                        $languages = App\Language::all(); 
                    @endphp
                    @if(isset($languages) && count($languages) > 0)
                    <div class="footer-dropdown">
                        <a href="#" class="a" data-toggle="dropdown"><i class="fa fa-globe rgt-15"></i>{{Session::has('changed_language') ? ucfirst(Session::get('changed_language')) : ''}}<i class="fa fa-angle-up lft-10"></i></a>
                        
                       
                        <ul class="dropdown-menu">
                          
                            @foreach($languages as $language)
                            <a href="{{ route('languageSwitch', $language->local) }}"><li>{{$language->name}}</li></a>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                </div>
                @endif
                
            </div>
        </div>
    </div>
    <hr>
    <div class="tiny-footer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="logo-footer">
                        <ul>

                            <li>{{ $cpy_txt }}</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="copyright-social">
                        <ul>
                            <li><a href="{{url('terms_condition')}}" title="Terms">{{ __('frontstaticword.Terms&Condition') }}</a></li> 
                            <li><a href="{{url('privacy_policy')}}" title="Policy">{{ __('frontstaticword.PrivacyPolicy') }}</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>

@include('instructormodel')
