<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use Date;

/**
 * Class Post
 * @package App
 */
class Post extends Model
{
    //
    /**
     * @var array
     */
    protected $fillable = [
        'title', 'slug', 'author', 'body','published_date', 'visibility', 'share_counter', 'views'
    ];

    /**
     * @var array
     * Set date type fields to Carbon\Carbon instances
     */
    protected $dates = ['published_date'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class,'tag_post');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Post has an image/media.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function media()
    {
        return $this->belongsTo(Media::class,'media_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function like(){
        return $this->hasOne(Like::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @param $date
     * Mutators manipulate data before insert on db
     */
    public function setPublishedDateAttribute($date)
    {
       $this->attributes['published_date'] = Carbon::parse($date);
    }

    /**
     * @param $date
     * @return mixed
     */
    public function getPublishedDateAttribute($date)
    {
        return Date::parse($date);
    }

    /**
     * @param $slug
     */
    public function setSlugAttribute($slug)
    {
        $this->attributes['slug'] = str_slug($slug);
    }
    /**
     * @param $query
     * Scopes are used for creating custom queries
     * Gets all articles/posts that are currently published
     */
     public function scopePublished($query)
     {
        $query->where('published_date','<=',Carbon::now());
     }

    public function scopeSearch($query,$search)
    {
        $query->where('title','LIKE',"%$search%")
            ->orWhere('body','LIKE',"%$search%");
    }

    /**
     * @param $query
     */
    public function scopePublic($query)
    {
        $query->where('visibility',1);
    }

    /**
     * @param $query
     */
    public function scopePrivate($query)
    {
        $query->where('visibility',0);
    }
    /**
     * @param $query
     * Gets all articles/posts that are set to be published on teh future
     */
    public function scopeUnPublished($query)
    {
        $query->where('published_date','>',Carbon::now());
    }

    /**
     * Gets list of categories associated with an article
     * @return array
     */
    public function getTagListAttribute()
    {
        return $this->tags()->lists('tags.id');
    }
    /**
     * A Post has one slider.
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function slider()
    {
        return $this->hasOne('App\Slider');
    }

    /**
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }
}
