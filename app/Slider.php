<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App
 */
class Slider extends Authenticatable
{

    /**
     * @var string
     */
    protected $table = "slider";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    /**
     * Has many associated posts.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images(){
        return $this->hasMany(Media::class);
    }

    /**
     * @param Media $image
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function addImage(Media $image)
    {
        return $this->images()->save($image);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function post()
    {
        return $this->belongsTo('App\Post');
    }
}
