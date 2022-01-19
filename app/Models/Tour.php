<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tour extends Model
{
    use HasFactory;

    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;

    public const PRICE_CODES = ['LKR', 'USD'];

    protected $fillable = [
        'name',
        'slug',
        'main_destinations',
        'description',
        'status',
        'meta_keywords',
        'meta_description',
        'context',
        'days',
        'user_id',
        'country_id'
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function tourDays()
    {
        return $this->hasMany(TourDay::class);
    }

    public function tourMedia()
    {
        return $this->hasMany(TourMedia::class);
    }

    public function tourPrice()
    {
        return $this->hasMany(TourPrice::class);
    }

    public function tourDataGroup()
    {
        return $this->hasMany(TourDataGroup::class);
    }

    public function getFeaturedImageUrlAttribute()
    {
        $image = $this->tourMedia->where('type', TourMedia::TYPE_FEATURE_IMAGE)->first();
        return ($image) ? $image->image_path : null;
    }

    public function getBackgroundImageUrlAttribute()
    {
        $image = $this->tourMedia->where('type', TourMedia::TYPE_BACKGROUND_IMAGE)->first();
        return ($image) ? $image->image_path : null;
    }

    public function getPrice($code)
    {
        $tourPrice =  $this->tourPrice->where('code', $code)->first();
        return $tourPrice;
    }

    public function getTourInclude()
    {
        return $this->tourDataGroup->where('section', TourDataGroup::PRICE_INCLUDE);
    }

    public function getTourExclude()
    {
        return $this->tourDataGroup->where('section', TourDataGroup::PRICE_EXCLUDE);
    }
}
