<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    protected $table = 'settings';

    protected $fillable = ['logo', 'favicon', 'paytm_enable', 'project_title', 'promo_text', 'donation_link'];

    protected $casts = [
        'ipblock' => 'array'
    ];
}
