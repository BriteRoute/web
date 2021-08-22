<?php

use App\FaqStudent;
use App\FaqInstructor;
use App\User;
use App\Setting;
use App\CourseClass;
use App\Course;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['web'])->group(function () {
    Route::view('/accessdenied','accessdenied')->name('inactive');
    Route::get('/offline','GuestController@offlineview');

    //Installer Routes
    Route::get('/install/proceed/Eula','InstallerController@eula')->name('installer');
    Route::post('/install/proceed/Eula','InstallerController@storeeula')->name('store.eula');
    Route::get('/install/proceed/servercheck','InstallerController@serverCheck')->name('servercheck');
    Route::post('/install/proceed/servercheck','InstallerController@storeserver')->name('store.server');
    Route::get('verifylicense','InstallerController@verifylicense')->name('verifylicense');
    Route::get('install/proceed/verifyapp','InstallerController@verify')->name('verifyApp');
    Route::post('verifycode','InitializeController@verify');
    Route::get('/install/proceed/step1','InstallerController@index')->name('installApp');
    Route::post('store/step1','InstallerController@step1')->name('store.step1');
    Route::get('get/step2','InstallerController@getstep2')->name('get.step2');
    Route::post('store/step2','InstallerController@step2')->name('store.step2');
    Route::get('get/step3','InstallerController@getstep3')->name('get.step3');
    Route::post('store/step3','InstallerController@storeStep3')->name('store.step3');
    Route::get('get/step4','InstallerController@getstep4')->name('get.step4');
    Route::post('store/step4','InstallerController@storeStep4')->name('store.step4');
    Route::get('get/step5','InstallerController@getstep5')->name('get.step5');
    Route::post('store/step5','InstallerController@storeStep5')->name('store.step5');

    Route::get('bigblue/api/callback','BigBlueController@logout');

    //Updater Routes
    Route::get('/ota/update', 'OtaUpdateController@getotaview')->name('ota.update');
    Route::post('/ota/proccess', 'OtaUpdateController@update')->name('update.proccess');
    Route::get('update/process', 'OtaUpdateController@updateprocess')->name('update.process');
    Route::post('/change-domain','AdminController@changedomain');


    Route::view('/ipblock','ipblock')->name('ip.block');
    Route::get('show/comingsoon','ComingSoonController@comingsoonpage')
        ->name('comingsoon.show');

    Route::get('getsecretkey', 'GenerateApiController@getkey')->name('get.api.key')->middleware('is_admin');
    Route::post('createkey', 'GenerateApiController@createKey')->middleware('is_admin')->name('apikey.create');

    Route::post('/verify-2fa','TwoFactorAuthController@verify')->middleware('auth');

    

  Route::middleware(['IsInstalled' ,'switch_languages', 'ip_block'])->group(function () {

    // Auth Routes
    Route::get('auth/{provider}', 'Auth\AuthController@redirectToProvider');
    Route::get('auth/{provider}/callback', 'Auth\AuthController@handleProviderCallback');


    Route::middleware(['is_verified', 'maintanance_mode'])->group(function () {

        Route::get('/', 'HomeController@index');
        Route::get('/home', 'HomeController@index')->name('home');

    });

    Auth::routes(['verify' => true]);

    Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}/{hash}', 'Auth\VerificationController@verify')->name('verification.verify');
    Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
 

    Route::prefix('admins')->group(function (){
        Route::get('/', 'AdminController@index')->name('admin.index');
    });

    Route::middleware(['is_active', 'auth', 'maintanance_mode'])->group(function () {

        Route::middleware(['is_admin'])->group(function () {

            Route::get('/clear-cache',function(){
                \Artisan::call('cache:clear');
                \Artisan::call('view:cache');
                \Artisan::call('view:clear');

                Alert::success('Cache has been cleared !')->persistent('Close')->autoclose(6000);

                return back();
            });

            Route::get('database/import', 'DatabaseController@demoimport')->name('import.view');
            Route::post('admin/import/demo', 'DatabaseController@importdatabase')->name('import.database');
            Route::post('admin/reset/demo', 'DatabaseController@resetdatabase')->name('reset.database');

            // Player Settings
            Route::get('/admin/playersetting','PlayerSettingController@get')->name('player.set');
            Route::post('/admin/playersetting/update','PlayerSettingController@update')->name('player.update');

            Route::get('admin/ads','AdsController@getAds')->name('ads');
            Route::post('admin/ads/insert','AdsController@store')->name('ad.store');

            Route::get('admin/ads/setting','AdsController@getAdsSettings')->name('ad.setting');

            Route::put('admin/ads/timer','AdsController@updateAd')->name('ad.update');

            Route::put('admin/ads/pop','AdsController@updatePopAd')->name('ad.pop.update');

            Route::delete('admin/ads/delete/{id}','AdsController@delete')->name('ad.delete');

            Route::get('admin/ads/create','AdsController@create')->name('ad.create');

            Route::get('admin/ads/edit/{id}','AdsController@showEdit')->name('ad.edit');

            Route::put('admin/ads/edit/{id}','AdsController@updateADSOLO')->name('ad.update.solo');

            Route::put('admin/ads/video/{id}','AdsController@updateVideoAD')->name('ad.update.video');

            Route::post('admin/ads/bulk_delete', 'AdsController@bulk_delete');

            Route::post('/quickupdate/course/{id}','QuickUpdateController@courseQuick')->name('course.quick');
            Route::post('/quickupdate/user/{id}','QuickUpdateController@userQuick')->name('user.quick');
            Route::post('/quickupdate/slider/{id}','QuickUpdateController@sliderQuick')->name('slider.quick');
            Route::post('/quickudate/course/{id}','QuickUpdateController@courseabc')->name('course.featured');
            Route::post('/quickupdate/category/{id}','QuickUpdateController@categoryQuick')->name('category.quick');
            Route::post('/quickupdate/language/{id}','QuickUpdateController@languageQuick')->name('language.quick');
            Route::post('/quickupdate/pag/{id}','QuickUpdateController@pageQuick')->name('page.quick');
            Route::post('/quickupdate/what/{id}','QuickUpdateController@whatQuick')->name('what.quick');
            Route::post('/quickupdate/ansr/{id}','QuickUpdateController@ansrQuick')->name('ansr.quick');
            Route::post('/quickupdate/Chapter/{id}','QuickUpdateController@ChapterQuick')->name('Chapter.quick');
            Route::post('/quickupdate/testimonial/{id}','QuickUpdateController@testimonialQuick')->name('testimonial.quick');
            Route::post('/quickupdate/subcategory/{id}','QuickUpdateController@subcategoryQuick')->name('subcategory.quick');
            Route::post('/quickupdate/childcategory/{id}','QuickUpdateController@childcategoryQuick')->name('childcategory.quick');
            Route::post('/quickupdate/y/{id}','QuickUpdateController@categoryfQuick')->name('categoryf.quick');
            Route::post('/quickupdate/blog_status/{id}','QuickUpdateController@blog_statusQuick')->name('blog.status.quick');
            Route::post('/quickupdate/blog_approved/{id}','QuickUpdateController@blog_approvedQuick')->name('blog.approved.quick');
            Route::post('/quickupdate/status/{id}','QuickUpdateController@reviewstatusQuick')->name('reviewstatus.quick');
            Route::post('/quickupdate/approved/{id}','QuickUpdateController@reviewapprovedQuick')->name('reviewapproved.quick');
            Route::post('/quickupdate/featured/{id}','QuickUpdateController@reviewfeaturedQuick')->name('reviewfeatured.quick');
            Route::post('/quickupdate/faq/{id}','QuickUpdateController@faqQuick')->name('faq.quick');
            Route::post('/quickupdate/faqinstructor/{id}','QuickUpdateController@faqInstructorQuick')->name('faqInstructor.quick');

            Route::post('/quickupdate/order/{id}','QuickUpdateController@orderQuick')->name('order.quick');

            Route::prefix('user')->group(function (){
            Route::get('/','UserController@viewAllUser')->name('user.index');
            Route::get('/adduser','UserController@create')->name('user.add');
            Route::post('/insertuser','UserController@store')->name('user.store');
            Route::get('edit/{id}','UserController@edit')->name('user.edit');
            Route::put('/edit/{id}','UserController@update')->name('user.update');   
            Route::delete('delete/{id}','UserController@destroy')->name('user.delete');
            });

            Route::resource("admin/country","CountryController");
            Route::resource("admin/state","StateController");
            Route::resource("admin/city","CityController");

            Route::resource('page','PageController');
            Route::resource('/testimonial','TestimonialController');
            Route::resource('slider','SliderController');
            Route::resource('trusted','TrustedController');
            

            Route::post('mailsetting/update','SettingController@updateMailSetting')->name('update.mail.set');
            Route::get('settings','SettingController@genreal')->name('gen.set');
            Route::post('setting/store','SettingController@store')->name('setting.store');
            Route::post('setting/seo','SettingController@updateSeo')->name('seo.set');
            Route::post('setting/addcss','SettingController@storeCSS')->name('css.store');
            Route::post('setting/addjs','SettingController@storeJS')->name('js.store');
            Route::post('setting/sociallogin/fb','SettingController@slfb')->name('sl.fb');
            Route::post('setting/sociallogin/gl','SettingController@slgl')->name('sl.gl');
            Route::post('setting/sociallogin/git','SettingController@slgit')->name('sl.git');
            Route::post('setting/sociallogin/amazon','SettingController@slamazon')->name('sl.amazon');
            Route::post('setting/sociallogin/linkedin','SettingController@sllinkedin')->name('sl.linkedin');
            Route::post('setting/sociallogin/twitter','SettingController@sltwitter')->name('sl.twitter');

            Route::get('/admin/api','ApiController@setApiView')->name('api.setApiView');
            Route::post('admin/api','ApiController@changeEnvKeys')->name('api.update');
            Route::put('/review/update/{id}','ReviewratingController@update')
            ->name('review.update');

            Route::resource('facts', 'SliderfactsController');
            Route::get('coursetext', 'CoursetextController@show');
            Route::put('coursetext/update', 'CoursetextController@update');
            Route::get('getstarted', 'GetstartedController@show');
            Route::put('getstarted/update', 'GetstartedController@update');
            Route::get('terms', 'TermsController@show')->name('termscondition');
            Route::put('termscondition', 'TermsController@update');
            Route::get('policy', 'TermsController@showpolicy')->name('policy');
            Route::put('privacypolicy', 'TermsController@updatepolicy');

            Route::resource('reports','ReportReviewController');
            Route::get('aboutpage', 'AboutController@show')->name('about.page');
            Route::put('aboutupdate', 'AboutController@update');
            Route::get('comingsoon', 'ComingSoonController@show')->name('comingsoon.page');
            Route::put('comingsoonupdate', 'ComingSoonController@update');
            Route::get('careers', 'CareersController@show')->name('careers.page');
            Route::put('careers/update', 'CareersController@update');
            Route::resource('faq','FaqController');
            Route::resource('faqinstructor','FaqInstructorController');
            Route::resource('carts', 'CartController');

            Route::get('currency', 'CurrencyController@show');
            Route::put('currency/update', 'CurrencyController@update');

            Route::get('widget', 'WidgetController@edit')->name('widget.setting');
            Route::put('widget/update', 'WidgetController@update');
            Route::post('admin/class/{id}/addsubtitle','SubtitleController@post')->name('add.subtitle');
            Route::post('admin/class/{id}/delete/subtitle','SubtitleController@delete')->name('del.subtitle');

            Route::get('frontslider', 'CategorySliderController@show')->name('category.slider');
            Route::put('frontslider/update', 'CategorySliderController@update');

            Route::resource('coupon','CouponController');
            Route::get('all/instructor', 'InstructorRequestController@allinstructor')->name('all.instructor');
            

            Route::resource('admin/report/view','CourseReportController');

            Route::get('banktransfer', 'BankTransferController@show')->name('bank.transfer');
            Route::put('banktransfer/update', 'BankTransferController@update');

            Route::get('admin/lang', 'LanguageController@showlang')->name('show.lang');

            Route::get('admin/frontstatic/{local}', 'LanguageController@frontstaticword')->name('frontstatic.lang');

            Route::post('/admin/update/{lang}/frontTranslations/content','LanguageController@frontupdate')->name('static.trans.update');

            Route::get('admin/adminstatic/{local}', 'LanguageController@adminstaticword')->name('adminstatic.lang');

            Route::post('/admin/update/{lang}/adminTranslations/content','LanguageController@adminupdate')->name('admin.static.update');

            Route::get('admin/flashmsg/{local}', 'LanguageController@flashmsgword')->name('flashmsg.lang');

            Route::post('/flashmsg/update/{lang}/flashmsgTranslations/content','LanguageController@flashupdate')->name('flashmsg.update');

            Route::get('admin/pwa', 'PwaSettingController@index')->name('show.pwa');

            Route::post('/admin/pwa/update/manifest','PwaSettingController@updatemanifest')->name('manifest.update');

            Route::post('/admin/pwa/update/sw','PwaSettingController@updatesw')->name('sw.update');

            Route::post('/admin/pwa/update/icons','PwaSettingController@updateicons')->name('icons.update');

            Route::post('/admin/manualcity','CityController@addcity')->name('city.manual');

            Route::post('/admin/manualstate','StateController@addstate')->name('state.manual');

            Route::resource('user/question/report','QuestionReportController');

            // adsense routes
            Route::get('/admin/adsensesetting/','AdsenseController@index')->name('adsense');
            Route::put('/admin/adsensesetting','AdsenseController@update')->name('adsense.update');

            Route::get('admin/ipblock', 'IPBlockController@view')->name('ipblock.view');
            Route::post('admin/ipblock/update', 'IPBlockController@update')->name('ipblock.update');

            // sitemap routes
            Route::post('sitemap', 'SiteMapController@sitemap');
            Route::get('show/sitemap', 'SiteMapController@index')->name('show.sitemap');
            Route::post('download/sitemap', 'SiteMapController@download')->name('download.sitemap');

            // whatsapp button routes
            Route::get('whatsapp/settings', 'WhatsappButtonController@show')->name('whatsapp.button');
            Route::post('whatsapp/update', 'WhatsappButtonController@update')->name('whatsapp.update');

            Route::get('recordings/meeting','BigBlueController@getrecordings')->name('download.meeting');
            Route::resource('batch', 'BatchController');

            Route::resource('refundpolicy', 'RefundPolicyController');
            Route::resource('refundorder', 'RefundController');

            Route::get('admin/coloroption', 'ColorOptionController@index')->name('coloroption.view');
            Route::post('admin/coloroption/update', 'ColorOptionController@update')->name('coloroption.update');
            Route::get('admin/coloroption/reset', 'ColorOptionController@reset')->name('coloroption.reset');

            Route::get('database/backup', 'DatabaseController@index')->name('database.backup');
            Route::post('database/genrate', 'DatabaseController@genrate')->name('database.genrate');
            Route::post('database/delete', 'DatabaseController@deletebackup')->name('database.delete');

            Route::get('database/download/{filename}', 'DatabaseController@download')->name('database.download');
            Route::post('database/dump', 'DatabaseController@update')->name('database.dump');

            Route::resource('advertisement','AdvertisementController');

            Route::resource('manualpayment','ManualPaymentController');

            Route::get('order/enroll/{user_id}', 'OrderController@enrollUser')->name('order.enrolluserview');


            Route::resource('attandance','AttandanceController');
            Route::get('view/users/{id}', 'AttandanceController@enrolled')->name('enrolled.users');
            Route::get('user/attandance/{id}/{course}', 'AttandanceController@attandance')->name('user.attandance');

            Route::get('/admin/push-notifications','OneSignalNotificationController@index')->name('onesignal.settings');
            Route::post('/admin/onesignal/keys','OneSignalNotificationController@updateKeys')->name('onesignal.update');
            Route::post('/admin/push-notifications','OneSignalNotificationController@push')->name('admin.push.notif');


            Route::get('/admin/import/quiz', 'QuizController@importquiz')->name('import.quiz');
            Route::post('admin/import', 'QuizController@import')->name('import');


            Route::get('quick/update', 'ReplaceFilesController@index')->name('quick.update');
            Route::post('replace', 'ReplaceFilesController@replace')->name('replace');

            Route::get('twilio/settings','TwilioController@index')->name('twilio.settings');
            Route::post('twilio/update','TwilioController@update')->name('twilio.update');


            Route::get('activity/users','UserActivityController@index')->name('activity.index');
            Route::post('activity/delete/{id}','UserActivityController@delete')->name('activity.delete');

            Route::get('remove/public','SupportController@index')->name('remove.public');
            Route::post('add/content','SupportController@addcontent')->name('add.content');
            Route::post('create/file','SupportController@createfile')->name('create.file');

            Route::resource('subscription/plan','InstructorPlanController');
            Route::resource('orders/subscription', 'SubscribedOrdersController');

            Route::get('quiz/review', 'QuizController@quizreview')->name('quiz.review');
            Route::post('quizreview/approve/{id}', 'QuizController@quizreviewQuick')->name('quizreview.quick');

            Route::resource('directory','SeoDirectoryController');
            Route::get('/directory/show/{id}/{city}', 'SeoDirectoryController@view')->name('directory.view');

            Route::resource('previous-paper','PreviousPaperController');

            Route::resource('private-course','PrivateCourseController');
            Route::resource('meeting-recordings','MeetingRecordingController');

            Route::get('plan/subscribe/settings', 'SubscriptionEnableController@view')->name('plan.settings');
            Route::post('plan/subscribe/update', 'SubscriptionEnableController@settings')->name('plan.settings.update');



            // ======== googlemeet start =============================
            Route::prefix('googlemeet')->group(function (){

                Route::get('dashboard','GoogleMeetController@dashboard')->name('googlemeet.index');
                Route::get('create/meeting','GoogleMeetController@create')->name('googlemeet.meeting.create');
                Route::post('store/new/meeting','GoogleMeetController@store')->name('googlemeet.store');
                Route::delete('delete/meeting/{id}','GoogleMeetController@delete')->name('googlemeet.delete');
                Route::get('edit/meeting/{meetingid}','GoogleMeetController@edit')->name('googlemeet.edit');
                Route::post('update/meeting/{meetingid}','GoogleMeetController@updatemeeting')->name('googlemeet.update');
                Route::post('googlement-token/update','GoogleMeetController@googleupdatefile')->name('googlemeet.updatefile');
            });

            Route::get('setting','GoogleMeetController@googlemeetsetting')->name('googlemeet.setting');
            Route::get('setting','GoogleMeetController@googlemeetsetting')->name('googlemeet.setting');
            Route::get('oauth', ['as' => 'oauthCallback', 'uses' => 'GoogleMeetController@oauth']);

            Route::get('googlemeet/allmeeting', 'GoogleMeetController@allgooglemeeting')->name('googlemeet.allgooglemeeting');
            // ======== googlemeet end ===============================

            Route::get('/admin/addon', 'AddonController@addon')->name('admin.addon');
            Route::get('/admin/add/addon', 'AddonController@addaddon')->name('add.addon');
            Route::post('/admin/install/addon', 'AddonController@installaddon')->name('install.addon');
            Route::post('/admin/addon/status/{module}', 'AddonController@status')->name('status.addon');
            Route::post('/admin/addon/delete/{module}', 'AddonController@delete')->name('addon.delete');



            Route::get('/admin/revenue/report', 'RevenueReportController@report')->name('admin.revenue.report');
            Route::get('/revenue/report/instructor', 'RevenueReportController@instructorReport')->name('instructor.revenue.report');

        });

        Route::middleware(['admin_instructor', 'IsInstalled'])->group(function () {

        
            try {
                \DB::connection()->getPdo();

                if(\DB::connection()->getDatabaseName() && Schema::hasTable('settings')){
                    if(env('IS_INSTALLED') == 1){
                        $vod = Setting::first();
                        
                        if(isset($vod) && $vod->zoom_enable == 1){
                            
                            Route::prefix('zoom')->group(function (){
                                Route::get('setting','ZoomController@setting')->name('zoom.setting');
                                Route::get('dashboard','ZoomController@dashboard')->name('zoom.index');
                                Route::post('token/update','ZoomController@updateToken')->name('updateToken');
                                Route::get('create/meeting','ZoomController@create')->name('meeting.create');
                                Route::delete('delete/meeting/{id}','ZoomController@delete')->name('zoom.delete');
                                Route::post('store/new/meeting','ZoomController@store')->name('zoom.store');
                                Route::get('edit/meeting/{meetingid}','ZoomController@edit')->name('zoom.edit');
                                Route::post('update/meeting/{meetingid}','ZoomController@updatemeeting')->name('zoom.update');
                                Route::get('show/meeting/{meetingid}','ZoomController@show')->name('zoom.show');
                            });
                        }

                        if(isset($vod) && $vod->bbl_enable == 1){
                            Route::prefix('bigblue')->group(function (){
                                Route::view('setting','bbl.setting')->name('bbl.setting');
                                Route::post('setting','BigBlueController@setting')->name('bbl.update.setting');
                                Route::get('meetings','BigBlueController@index')->name('bbl.all.meeting');
                                Route::view('meeting/create','bbl.create')->name('bbl.create');
                                Route::post('meeting/store','BigBlueController@store')->name('bbl.store');
                                Route::get('meeting/edit/{meetingid}','BigBlueController@edit')->name('bbl.edit');
                                Route::post('meeting/update/{meetingid}','BigBlueController@update')->name('bbl.update');
                                Route::delete('meeting/delete/{id}','BigBlueController@delete')->name('bbl.delete');
                                Route::get('api/create/meeting/{id}','BigBlueController@apiCreate')->name('api.create.meeting');

                                
                            });
                        }
                    }
                }
            }
            catch(\Exception $ex){

              return redirect('/get/step2');
            }

            // ====== jisti meeting start ==========
            Route::get('jitsi-dashboard', 'JitsiController@jitsidashboard')->name('jitsi.dashboard');
            Route::get('jitsi-create', 'JitsiController@jitsicreate')->name('jitsi.create');
            Route::post('jitsi-meeting-save', 'JitsiController@savejitsimeeting')->name('jitsi.meeting.save');
            Route::delete('delete-meeting/{id}', 'JitsiController@deletemeeting')->name('deletemeeting.jitsi');
            // ====== jisti meeting end =============


            Route::prefix('user')->group(function (){
              Route::get('edit/{id}','UserController@edit')->name('user.edit');
              Route::put('/edit/{id}','UserController@update')->name('user.update');
            });

            Route::resource('category','CategoriesController');
            Route::get('/category/{slug}','CategoriesController@show')->name('category.show'); 
            Route::resource('subcategory','SubcategoryController');
            Route::resource('childcategory','ChildcategoryController');
            Route::resource('course','CourseController');
            Route::resource('courseinclude','CourseincludeController');
            Route::resource('coursechapter','CoursechapterController');
            Route::resource('whatlearns','WhatlearnsController');
            Route::resource('relatedcourse','RelatedcourseController');
            Route::resource('questionanswer','QuestionanswerController');
            Route::resource('courseanswer', 'AnswerController');
            Route::resource('courseclass','CourseclassController');
            Route::resource('reviewrating','ReviewratingController');
            Route::resource('announsment','AnnounsmentController');
            Route::get('/course/create/{id}','CourseController@showCourse')->name('course.show');
            Route::post('/category/insert','CategoriesController@categoryStore')->name('cat.store');
            Route::post('/subcategory/insert','SubcategoryController@SubcategoryStore')->name('child.store');
            Route::put('/course/include/{id}','CourseController@testup')->name('corinc.update');
            Route::put('/course/whatlearns/{id}','CourseController@test')->name('what.update');
            Route::put('/course/coursechapter/{id}','CourseController@tes')->name('chapter.update');
            Route::get('send', 'CourseclassController@store')->name('notification');
            Route::resource('courselang','CourseLanguageController');
            Route::get("admin/dropdown","CourseController@upload_info");
            Route::get("admin/gcat","CourseController@gcato");


            Route::get('instructor', 'InstructorController@index')->name('instructor.index');
            Route::resource('userenroll', 'InstructorEnrollController');
            Route::resource('instructorquestion', 'InstructorQuestionController');
            Route::resource('instructoranswer', 'InstructorAnswerController');
            Route::resource('coursereview', 'CourseReviewController');

            Route::resource('instructor/announcement', 'InstructorAnnouncementController');
            Route::resource('usermessage', 'ContactUsController');
            Route::resource('languages', 'LanguageController');

            Route::get('reposition/category', 'CategoriesController@reposition')->name('category_reposition');
            Route::post('reposition/class', 'CourseclassController@sort')->name('class-sort');
            Route::get('reposition/slider', 'SliderController@reposition')->name('slider_reposition');
            Route::post('reposition/chapter', 'CoursechapterController@sort')->name('chapter-sort');

            Route::resource('admin/quiztopic', 'QuizTopicController');
            Route::resource('/admin/questions', 'QuizController');
            Route::resource('blog', 'BlogController');
            Route::resource('order', 'OrderController');
            Route::resource('featurecourse', 'FeatureCourseController');

            Route::post('/paywithpaytm', 'FeatureCourseController@order')->name('paywithpaytm');
            Route::get('/featurepayment/status', 'FeatureCourseController@paymentCallback');

            Route::post('featuredwithpaypal', 'FeatureCourseController@payWithpaypal')->name('featuredWithpaypal');
            Route::get('getfeaturedstatus', 'FeatureCourseController@getPaymentStatus')->name('featured');

            Route::resource('bundle', 'BundleCourseController');
            Route::resource('assignment', 'AssignmentController');
            Route::resource('appointment', 'AppointmentController');

            Route::get('view/order/admin/{id}', 'OrderController@vieworder')->name('view.order');
            Route::get('all/assignment', 'AssignmentController@view')->name('assignment.view');
            Route::get('view/assignment/{id}', 'AssignmentController@assignment')->name('list.assignment');
            Route::get('show/quizreport/{id}', 'QuizTopicController@showreport')->name('show.quizreport');

            // Involment routes
            Route::get('/admin/request/involve/','RequestInvolveController@index')->name('allrequestinvolve');
            Route::post('/admin/involve/create/{id}','InvolvementController@store')->name('involve.store');
            Route::get('/involve/request', 'InvolvementController@index')->name('involve.request.index');
            Route::post('/involve/request/edit/{id}', 'InvolvementController@update')->name('involve.request.edit');
            Route::delete('/involve/request/destroy/{id}', 'InvolvementController@destroy')->name('involve.request.destroy');
            Route::get('/involve/request/allinvolvements', 'InvolvementController@show')->name('involve.request');

            Route::get('payout/download/{id}', 'CompletedPayoutController@pdfdownload')->name('payout.download');

            Route::get('rejected/courses', 'CourseReviewController@rejected')->name('courses.reject');
            Route::get('rejected/view/{id}', 'CourseReviewController@rejectedview')->name('courses.view');

        });
    });
      
    Route::middleware(['is_verified', '2fa'])->group(function () {

        Route::resource('requestinstructor', 'InstructorRequestController');
        Route::get('instructor/{id}/{name}', 'InstructorSettingController@instructorprofile')->name('instructor.profile');

        Route::post('rating/show/{id}','ReviewratingController@rating')->name('course.rating');
        Route::post('reports/insert/{id}','ReportReviewController@store')->name('report.review');
        Route::get('/course/{id}/{slug}','CourseController@CourseDetailPage')->name('user.course.show');
        Route::get('all/blog','BlogController@blogpage')->name('blog.all');
        Route::get('about/show','AboutController@aboutpage')->name('about.show');
        
        Route::get('show/careers','CareersController@careerpage')->name('careers.show');
        Route::get('detail/blog/{id}/{slug}','BlogController@blogdetailpage')->name('blog.detail');
        Route::get('gotomycourse', 'CourseController@mycoursepage')->name('mycourse.show');

        Route::get('show/help', function(){
        $data = FaqStudent::first();
        $item = FaqInstructor::first();
        return view('front.help.faq',compact('data', 'item')); 
        })->name('help.show');

        Route::get('pages/{slug}','PageController@showpage')->name('page.show');

        Route::post('show/wishlist/{id}','WishlistController@wishlist');
        Route::post('remove/wishlist/{id}','WishlistController@removewishlist');

        Route::get('enroll/show/{id}', 'EnrollmentController@enroll')->name('show.enroll');

        Route::get('/coursecontent/{id}/{slug}', 'CourseController@CourseContentPage')->name('course.content');

        Route::post('addquestion/{id}','QuestionanswerController@question');
        Route::post('addanswer/{id}','AnswerController@answer');

        Route::get('all/wishlist', 'WishlistController@wishlistpage')->name('wishlist.show');
        Route::post('delete/wishlist/{id}', 'WishlistController@deletewishlist');

        Route::post('addtocart', 'CartController@addtocart')->name('addtocart');
        Route::post('removefromcart/{id}','CartController@removefromcart')
          ->name('remove.item.cart');
        Route::get('all/cart', 'CartController@cartpage')->name('cart.show');
        Route::post('gotocheckout', 'CheckoutController@checkoutpage');
        
        Route::get('notifications/{id}', 'NotificationController@markAsRead')
        ->name('markAsRead');
        Route::get('delete/notifications', 'NotificationController@delete')
        ->name('deleteNotification');

        Route::get('/view', 'DownloadController@getDownload');
        Route::get('/download/{id}', 'DownloadController@getDownload')->name('downloadPdf')->middleware('auth');

        
        

        Route::post('apply/instructor', 'InstructorRequestController@instructor')
        ->name('apply.instructor');

        Route::get('search', 'SearchController@index')->name('search');

        Route::get('/user/movie/time/{endtime}/{movie_id}/{user_id}','TimeHistoryController@movie_time');

        Route::get('all/purchase', 'OrderController@purchasehistory')->name('purchase.show');
        Route::get('invoice/show/{id}', 'OrderController@invoice')->name('invoice.show');
        
        Route::get('profile/show/{id}', 'UserProfileController@userprofilepage')->name('profile.show');
        Route::put('/edit/{id}','UserProfileController@userprofile')->name('user.profile');

        Route::post('course/reports/{id}','CourseReportController@store')->name('course.report');

        Route::get('watch/course/{id}', 'WatchController@watch')->name('watchcourse');
        Route::get('watch/courseclass/{id}', 'WatchController@watchclass')->name('watchcourseclass');
        Route::get('audio/courseclass/{id}', 'WatchController@audioclass')->name('audiocourseclass');

        Route::get('language-switch/{local}', 'LanguageSwitchController@languageSwitch')->name('languageSwitch');

        Route::get("country/dropdown","CountryController@upload_info");
        Route::get("country/gcity","CountryController@gcity");

        Route::view('terms_condition', 'terms_condition');
        Route::view('privacy_policy', 'privacy_policy');

        Route::get('detail/faq/{id}','HelpController@faqstudentpage')->name('faq.detail');
        Route::get('faqinstructor/detail/{id}','HelpController@faqinstructorpage')->name('faqinstructor.detail');

        Route::view('user_contact', 'front.contact');
        Route::post('contact/user', 'ContactUsController@usermessage')
        ->name('contact.user');

        Route::get('tabcontent/{id}','TabController@show');

        Route::post('paywithpaypal', 'PaypalController@payWithpaypal')->name('payWithpaypal');
        Route::get('getpaymentstatus', 'PaypalController@getPaymentStatus')->name('status');

        Route::get('event', 'InstaMojoController@index');
        Route::post('pay', 'InstaMojoController@pay');
        Route::get('pay-success', 'InstaMojoController@success');

        Route::get('stripe', 'StripePaymentController@stripe');
        Route::post('paytostripe', 'StripePaymentController@payStripe')->name('stripe.pay');

        

        Route::get('razorpay', 'RazorpayController@pay')->name('pay');
        Route::post('dopayment', 'RazorpayController@dopayment')->name('dopayment');

        Route::post('/paywithpaystack', 'PayStackController@redirectToGateway')->name('paywithpaystack');
        Route::get('callback', 'PayStackController@handleGatewayCallback')->name('paystack.callback'); 

        Route::post('/paywithpayment', 'PaytmController@order')->name('paywithpayment');
        Route::post('payment/status', 'PaytmController@paymentCallback');

        Route::post('process/banktransfer', 'BankTransferController@banktransfer');

        Route::post('apply/coupon', 'ApplyCouponController@applycoupon');

        Route::post('removecoupon/{id}','ApplyCouponController@remove')
          ->name('remove.coupon');
        
        Route::get('watchcourse/in/frame/{url}/{course_id}', 'WatchController@view')->name('watchinframe');

        Route::get('start_quiz/{id}', 'QuizStartController@quizstart')->name('start_quiz');
        Route::post('/start_quiz/store/{id}','QuizStartController@store')->name('start.quiz.store');
        Route::get('finish/{id}','QuizStartController@show')->name('start.quiz.show');

        Route::get('invoice/download/{id}', 'OrderController@pdfdownload')->name('invoice.download');

        Route::get('watch/lightbox/{id}', 'WatchController@lightbox')->name('lightbox');

        Route::post('question/reports/{id}','QuestionReportController@store')->name('question.report');

        Route::get('cirtificate/{id}', 'CertificateController@show')->name('cirtificate.show');

        Route::get('cirtificate/download/{id}', 'CertificateController@pdfdownload')->name('cirtificate.download');

        Route::get('answersheet/{id}', 'QuizTopicController@delete')->name('answersheet');
        Route::get('tryagain/{id}', 'QuizStartController@tryagain')->name('tryagain');

        Route::get('admin/instructor/settings', 'InstructorSettingController@view')->name('instructor.settings');
        Route::post('admin/instructor/update', 'InstructorSettingController@update')->name('instructor.update');
        Route::get('add/settings', 'InstructorSettingController@instructor')->name('instructor.pay');
        Route::post('instructor/payout/{id}', 'InstructorSettingController@settings')->name('instructor.payout');
        Route::get('pending/payout', 'PayoutController@pending')->name('pending.payout');
        Route::get('admin/instructor', 'AdminPayoutController@index')->name('admin.instructor');
        Route::get('admin/pending/{id}', 'AdminPayoutController@pending')->name('admin.pending');
        Route::get('admin/paid/{id}', 'AdminPayoutController@paid')->name('admin.paid');
        Route::post('admin/payout/bulk_payout/{id}', 'AdminPayoutController@bulk_payout');

        Route::post('admin/paypal/{id}', 'PaymentController@paypal')->name('admin.paypal');
        Route::post('admin/banktransfer/{id}', 'PaymentController@banktransfer')->name('admin.banktransfer');
        Route::post('admin/paytm/{id}', 'PaymentController@paytm')->name('admin.paytm');

        Route::get('admin/completed/payout', 'CompletedPayoutController@show')->name('admin.completed');
        Route::get('payout/completed/view/{id}', 'CompletedPayoutController@view')->name('completed.view');

        Route::get('admin/meeting/show', 'MeetingController@index')->name('meeting.show');
        Route::delete('destroy/meeting/{id}','MeetingController@destroy')->name('zoom.destroy');

        Route::post('course/checked/{id}', 'CourseProgressController@checked');

        Route::post('bundle/cart/{id}', 'BundleCourseController@addtocart')->name('bundlecart');
        Route::get('bundle/detail/{id}', 'BundleCourseController@detailpage')->name('bundle.detail');
        Route::get('bundle/enroll/{id}', 'BundleCourseController@enroll')->name('bundle.enroll');

        Route::get('bbl/detail/{id}', 'BigBlueController@detailpage')->name('bbl.detail');

        Route::get('join/meeting/{meetingid}','BigBlueController@joinview')->name('bbluserjoin');
        Route::post('api/join/meeting','BigBlueController@apiJoin')->name('bbl.api.join');

        Route::post('course/assignment/{id}', 'AssignmentController@submit')->name('assignment.submit');
        Route::post('assignment/delete/{id}', 'AssignmentController@delete');

        Route::post('course/appointment/{id}', 'AppointmentController@request')->name('appointment.request');
        Route::post('appointment/delete/{id}', 'AppointmentController@delete');

        Route::get('/activestatus', 'WatchCourseController@active');

        Route::get('active/courses', 'WatchCourseController@watchlist')->name('active.courses');
        Route::post('active/delete/{id}', 'WatchCourseController@delete')->name('active.delete');

        // payment routes
        Route::post('paywithpayu', 'PayUController@pay')->name('paywithpayu');
        Route::get('payu/payment/success', 'PayUController@success')->name('payu.success');

        Route::post('pay/via/cashfree', 'CashFreeController@pay')->name('cashfree.pay');
        Route::post('payviacashfree/success', 'CashFreeController@success');

        Route::post('payvia/moli/payment', 'MoliController@pay')->name('moli.pay');
        Route::get('/payviamoli/success', 'MoliController@success')->name('moli.pay.success');

        Route::post('payvia/skrill/payment', 'SkrillController@pay')->name('skrill.pay');
        Route::get('payvia/skrill/success', 'SkrillController@success');

        Route::post('payvia/rave/payment', 'RaveController@pay')->name('rave.pay');
        Route::get('/payvia/rave/success', 'RaveController@success')->name('rave.callback');

        Route::post('pay/via/omise', 'OmiseController@pay')->name('pay.via.omise');

        Route::post('payment/notify', 'PayHereController@notifyUrl' )->name('payhere.notifyUrl');
        Route::get ('payment/cancelUrl', 'PayHereController@cancelUrl')->name('payhere.cancelUrl');
        Route::get( 'payment/returnUrl', 'PayHereController@returnUrl' )->name('payhere.returnUrl');

        Route::get('zoom/detail/{id}', 'ZoomController@detailpage')->name('zoom.detail');

        Route::get('refund/proceed/{id}', 'OrderController@refundview')->name('refund.proceed');
        Route::post('refund/request/{id}', 'OrderController@refundrequest')->name('refund.request');

        Route::resource('bankdetail','UserBankController');

        Route::post('iyzico/izy/payment', 'IyzController@pay')->name('izy.pay');
        Route::post('return/izy/success', 'IyzController@callback')->name('izy.callback');

        Route::get('confirmation', 'OrderController@confirmation' )->name('confirmation');

        Route::get('browse/', 'CategoriesController@categorypage')->name('category.page');
        Route::get('browse/subcategory/', 'CategoriesController@subcategorypage')->name('subcategory.page');
        Route::get('browse/childcategory/', 'CategoriesController@childcategorypage')->name('childcategory.page');

        Route::post('cancelsubscription', 'StripePaymentController@cancelSubscription')->name('stripe.cancelsubscription');

        Route::get('batch/detail/{id}', 'BatchController@detailpage')->name('batch.detail');
        Route::post('batch/cart/{id}', 'BatchController@batchcart')->name('batchcart');

        Route::post('/payvia/sslcommerze', 'SslCommerzPaymentController@index')->name('payvia.sslcommerze');
        Route::post('payvia/sslcommerze/success', 'SslCommerzPaymentController@success');
        Route::post('payvia/sslcommerze/fail', 'SslCommerzPaymentController@fail');
        Route::post('payvias/sslcommerze/cancel', 'SslCommerzPaymentController@cancel');
        Route::post('/payvia/sslcommerze/ipn', 'SslCommerzPaymentController@ipn');

        Route::post('review/helpful/{id}', 'ReviewHelpfulController@store')->name('helpful');

        Route::get('/watchcourse/{user}/{code}/{id}','WatchApiController@watch_course');
        Route::get('/watchclass/{user}/{code}/{id}','WatchApiController@watch_class');

        Route::post('manualpay/pay', 'ManualPaymentController@checkout')->name('manualpay.checkout');

        Route::post('payment/success', 'AamarPayController@paymentSuccess')->name('payment.success');
        Route::post('payment/failed', 'AamarPayController@paymentFailed')->name('payment.failed');
        Route::get('payment/cancel', 'AamarPayController@paymentCancel')->name('payment.cancel');

        Route::post('/checkout', 'BraintreeController@payment')->name('payment.braintree');

        Route::get('sub_start_quiz/{id}', 'QuizStartController@subquizstart')->name('sub_start_quiz');
        Route::post('/sub_start_quiz/store/{id}','QuizStartController@sub_store')->name('sub.start.quiz.store');
        Route::get('sub_finish/{id}','QuizStartController@sub_show')->name('sub.start.quiz.show');

        Route::get('sub_tryagain/{id}', 'QuizStartController@subtryagain')->name('sub.tryagain');


        Route::get('plan/instructor/subscription', 'InstructorPlanController@planpage')->name('plan.page');
        Route::post('plan/checkout', 'InstructorPlanController@checkout')->name('plan.checkout');
        Route::post('subscribewithpaypal', 'PlanSubscribeController@paypal')->name('subscribewithpaypal');
        Route::get('callback/subscribewithpaypal', 'PlanSubscribeController@paypalcallback')->name('callbackpaypal');

        Route::post('plan/subscribe/paytm', 'PlanSubscribeController@paytm')->name('plansubscribepaytm');
        Route::get('/subscribeinstructor/status', 'PlanSubscribeController@paymentsubscribe');


        // ====== jisti meeting start ==========
        Route::get('meetup-conferencing/{meetup}','JitsiController@joinMeetup')->name('jitsi.meet');
        Route::get('jitsi/detail/{id}', 'JitsiController@jitsidetailpage')->name('jitsipage.detail');
        // ====== jisti meeting end =============

        // ==== google meet route start ===================
        Route::get('googlemeet/detail/{id}', 'GoogleMeetController@googlemeetdetailpage')->name('googlemeetdetailpage.detail');
        // ==== google meet route end =====================

        Route::group(['prefix'=>'2fa'], function(){
            Route::get('/','TwoFactorAuthController@show2faForm')->name('2fa.show');
            Route::post('/generateSecret','TwoFactorAuthController@generate2faSecret')->name('generate2faSecret');
            Route::post('/enable2fa','TwoFactorAuthController@enable2fa')->name('enable2fa');
            Route::post('/disable2fa','TwoFactorAuthController@disable2fa')->name('disable2fa');

        });


        Route::post('payvia/payflexi/payment', 'PayFlexiController@redirectToGateway')->name('payflexi.pay');
        Route::get('/payvia/payflexi/callback', 'PayFlexiController@callback')->name('payflexi.callback');
        Route::post('payvia/payflexi/webhook', 'PayFlexiController@webhook')->name('payflexi.webhook');

        Route::post('free/plan/checkout', 'PlanSubscribeController@freecheckout')->name('free.plan.checkout');
        

    });

  });

});

