<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class User
 * @package App
 */
class User extends Authenticatable {

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'document', 'avatar', 'provider_id', 'newsletter'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function like()
    {
        return $this->hasOne(Like::class);
    }

    /**
     * @param Post $post
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function createdThisPost(Post $post)
    {
        return $this->posts()->save($post);
    }

    /**
     * @return string
     */
    public function getProfileDisplay()
    {
        if ( ! empty($this->avatar)) {
            return '<img class="circle" style="width:100%" src="/' . $this->avatar . '">';
        }
        $first_name_initial = ! empty($this->first_name[0]) ? $this->first_name[0] : '';
        $last_name_initial = ! empty($this->last_name[0]) ? $this->last_name[0] : '';

        return strtoupper( $first_name_initial. $last_name_initial );

    }

    /**
     * @return string
     */
    public function getInitialsFromName()
    {
        $first_name_initial = ! empty($this->first_name[0]) ? $this->first_name[0] : '';
        $last_name_initial = ! empty($this->last_name[0]) ? $this->last_name[0] : '';

        return strtoupper( $first_name_initial. $last_name_initial );
    }

    /**
     *
     */
    public function makeSubscriber()
    {
        $subscriber = Role::where('name', 'subscriber')->get();
        $this->roles()->attach($subscriber);
    }

    public function getTagListAttribute()
    {
        return $this->tags()->lists('tags.id');
    }
}
