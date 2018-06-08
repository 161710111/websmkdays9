<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Programstudi extends Model
{
    protected $table = 'programstudis';
    protected $fillable = ['nama','keterangan','fasilitas_id','industri_id'];
    public $timestamps = true;

    	public function Fasilitas()
    	{
    		return $this ->belongsTo('App\Fasilitas','fasilitas_id');
    	}
    	public function Industri()
    	{
    		return $this ->belongsTo('App\Industri','industri_id');
    	}
}
