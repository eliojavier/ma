<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Youtube extends Model
{
    protected $table ='youtube';
    protected $fillable = ['youtube_id','choices'];
}
