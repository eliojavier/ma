<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Collaborator extends Model
{
    protected $fillable = ['complete_name', 'bio', 'avatar'];

    public function getProfileDisplay(){
        if(!empty($this->avatar)){
            return '<img style="width:100%" src="/'.$this->avatar.'">';
        }
        $nameArr = explode(' ',$this->complete_name, 2);
        if(count($nameArr) <= 1)
        {
            return strtoupper($nameArr[0][0]);
        }
        return  strtoupper($nameArr[0][0].$nameArr[1][0]);

    }

    public function Category()
    {
        return $this->belongsTo('App\Category');
    }

}
