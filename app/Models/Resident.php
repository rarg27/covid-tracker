<?php

namespace App\Models;

use App\Traits\FormattedTimestamp;
use Brackets\Media\HasMedia\AutoProcessMediaTrait;
use Brackets\Media\HasMedia\HasMediaCollectionsTrait;
use Brackets\Media\HasMedia\ProcessMediaTrait;
use Illuminate\Database\Eloquent\Model;
use Nicolaslopezj\Searchable\SearchableTrait;
use Spatie\MediaLibrary\HasMedia\HasMedia;

class Resident extends Model implements HasMedia
{
    use FormattedTimestamp,
        HasMediaCollectionsTrait,
        ProcessMediaTrait,
        SearchableTrait;

    protected $fillable = [
        'name',
        'address',
        'birth_date',
        'contact_number',
        'email',
        'status',
        'id_type',
        'id_value'
    ];

    protected $searchable = [
        'columns' => [
            'residents.name' => 10
        ]
    ];

    protected $appends = [
        'resource_url',
        'id_picture'
    ];

    public function getResourceUrlAttribute()
    {
        return url('/admin/residents/'.$this->getKey());
    }

    public function getIdPictureAttribute()
    {
        return optional($this->getFirstMedia('id_picture'))->getUrl();
    }

    public function registerMediaCollections() : void
    {
        $this->addMediaCollection('id_picture')
            ->accepts('image/*')
            ->singleFile();
    }
}
