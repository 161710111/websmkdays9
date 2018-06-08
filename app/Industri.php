<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Industri extends Model
{
    protected $table = 'industris';
    protected $fillable = ['logo','nama','deskripsi'];
    public $timestamps = true;

    	public function Programstudi()
    	{
    		return $this ->hasMany('App\Programstudi','industri_id');
    	}
}
