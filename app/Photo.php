<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

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
}
