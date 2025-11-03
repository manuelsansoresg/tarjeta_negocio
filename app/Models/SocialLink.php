<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialLink extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_profile_id', 'platform', 'url', 'icon_class', 'button_color', 'enabled', 'order'
    ];

    public function profile()
    {
        return $this->belongsTo(BusinessProfile::class, 'business_profile_id');
    }
}