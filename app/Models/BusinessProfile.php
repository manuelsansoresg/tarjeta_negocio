<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusinessProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'logo_path', 'primary_color', 'secondary_color', 'accent_color', 'background_color'
    ];

    public function socialLinks()
    {
        return $this->hasMany(SocialLink::class)->orderBy('order');
    }
}