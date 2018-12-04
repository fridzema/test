<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Storage;

class Photo extends Model
{
    protected static function boot()
		{
		    parent::boot();

		    // Order by name ASC
		    // static::addGlobalScope('ordered', function (Builder $builder) {
		    //     $builder->orderBy('order_index', 'asc');
		    // });
		}


    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'exif' => 'array',
        'iptc' => 'array',
    ];


    public function getDestinationPathAttribute()
    {
      return sprintf('%s/%s', sha1($this->id), $this->filename);
    }

    public function getUrlAttribute()
    {
      return (Storage::disk('photos_private')->exists($this->destination_path)) ? asset(Storage::disk('photos_private')->url($this->destination_path)) : config('system.image_placeholder_url');
    }
}
