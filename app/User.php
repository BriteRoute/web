<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Support\Str;
use Modules\Wallet\Models\Wallet;
use Modules\Wallet\Models\Affiliate;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, HasApiTokens;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'email', 'password', 'lname', 'dob', 'doa', 'mobile', 'address', 'city_id',
        'state_id', 'country_id', 'gender', 'pin_code', 'status', 'verified', 'role', 'married_status','user_img', 'detail', 'braintree_id', 'fb_url', 'twitter_url', 'youtube_url', 'linkedin_url', 'email_verified_at', 'code', 'google_id', 'facebook_id', 'amazon_id', 'gitlab_id', 'linkedin_id', 'twitter_id', 'jwt_token', 'zoom_email', 'referred_by', 'affiliate_id', 'google2fa_secret', 'google2fa_enable',
    ];

    

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'google2fa_secret',
    ];


    public static function createReferCode()
    {
        
        $seed = str_split('abcdefghijklmnopqrstuvwxyz'
            . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'
            . '0123456789!$&'); 
        shuffle($seed); 
        $rand = '';
        $affiliate = Affiliate::first();
        $ref_id = $affiliate->ref_length;
        foreach (array_rand($seed , $ref_id) as $k) {
            $rand .= $seed[$k];
        }
        return Str::upper($rand);
    }


    public function country()
    {
      return $this->belongsTo('App\Allcountry','country_id', 'id');
    }

    public function state()
    {
      return $this->belongsTo('App\Allstate','state_id','id');
    }   

    public function city()
    {
        return $this->belongsTo('App\Allcity','city_id','id');
    }                                                                                               
    public function courses()
    {
        return $this->hasMany('App\Course','user_id');

    }     
    public function answer()
    {
        return $this->hasMany('App\Question','user_id');
    }   

    public function announsment()
    {
        return $this->hasMany('App\Announcement','user_id');
    }  

    public function review()
    {
        return $this->hasMany('App\ReviewRating','user_id');
    } 

    public function reportreview()
    {
        return $this->hasMany('App\ReportReview','user_id');
    }  

    public function viewprocess()
    {
        return $this->hasMany('App\ViewProcess','user_id');
    }   

    public function wishlist()
    {
        return $this->hasMany('App\Wishlist','user_id');
    }  

    public function blogs()
    {
        return $this->hasMany('App\Blog','user_id');
    }

    public function relatedcourse()
    {
        return $this->hasMany('App\RelatedCourse','user_id');
    }

    public function courseclass()
    {
        return $this->hasMany('App\CourseClass','user_id');
    } 

    public function orders()
    {
        return $this->hasMany('App\Order','user_id');
    } 

    public function pending()
    {
        return $this->hasMany('App\PendingPayout','user_id');
    }
    
    public function liveclass()
    {
        return $this->hasMany('App\LiveCourse','user_id');
    } 

    public function completed()
    {
        return $this->hasMany('App\CompletedPayout','user_id');
    }  

    public function bundle()
    {
        return $this->hasMany('App\BundleCourse','user_id');
    } 

    public function plans()
    {
        return $this->hasMany('App\PlanSubscribe','user_id');
    }

    public function routeNotificationForOneSignal()
    {
        return ['include_external_user_ids' => [$this->id.""]];
    }


    public function wallet()
    {
        return $this->hasOne(Wallet::class, 'user_id', 'id');
    }


     
}

