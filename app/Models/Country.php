<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Traits\DataTableFilterTrait;

class Country extends Model
{
    use HasFactory;
    use DataTableFilterTrait;

    public const STATUS_ACTIVE = 1;
    public const STATUS_INACTIVE = 0;

    protected $featured_image_url = null;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'status',
        'meta_keywords',
        'meta_description',
        'user_id'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }

    public function countryMedia()
    {
        return $this->hasMany(CountryMedia::class);
    }

    public function getFeaturedImageUrlAttribute()
    {
        $image = $this->countryMedia->where('type', CountryMedia::TYPE_FEATURE_IMAGE)->first();
        return ($image) ? $image->image_path : null;
    }

    public function getBackgroundImageUrlAttribute()
    {
        $image = $this->countryMedia->where('type', CountryMedia::TYPE_BACKGROUND_IMAGE)->first();
        return ($image) ? $image->image_path : null;
    }
}
