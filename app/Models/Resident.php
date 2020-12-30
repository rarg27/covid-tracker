<?php

namespace App\Models;

use App\Traits\FormattedTimestamp;
use Brackets\Media\HasMedia\AutoProcessMediaTrait;
use Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use Brackets\Media\HasMedia\ProcessMediaTrait;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\MediaLibrary\Models\Media;

class Resident extends Model implements HasMedia
{
    use FormattedTimestamp,
        HasMediaTrait,
        SearchableTrait;

    protected $fillable = [
        'name',
        'address',
        'birth_date',
        'contact_number'
    ];

    protected $searchable = [
        'columns' => [
            'residents.name' => 10
        ]
    ];

    protected $appends = [
        'resource_url',
        'picture',
        'picture_thumb'
    ];

    public function getResourceUrlAttribute()
    {
        return url('/admin/residents/'.$this->getKey());
    }

    public function getPictureAttribute()
    {
        return optional($this->getFirstMedia('picture'))->getUrl();
    }

    public function getPictureThumbAttribute()
    {
        return optional($this->getFirstMedia('picture'))->getUrl('thumb');
    }

    public function registerMediaCollections()
    {
        $this->addMediaCollection('picture')
            ->singleFile();
    }

    public function registerMediaConversions(Media $media = null)
    {
        $this->addMediaConversion('thumb')
            ->width(160)
            ->height(120)
            ->sharpen(10);
    }
}
