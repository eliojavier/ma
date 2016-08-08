<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App
 */
class Category extends Model
{

    /**
     * @var array
     */
    protected $fillable = ['display_name', 'slug', 'description','style'];
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tags(){
        return $this->hasMany(Tag::class);
    }

    /**
     * A category has one slider.
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function slider()
    {
        return $this->hasOne('App\Slider');
    }

    public function collaborator()
    {
        return $this->hasOne('App\Collaborator');
    }
}
