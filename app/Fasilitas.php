<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fasilitas extends Model
{
    protected $table = 'fasilitas';
    protected $fillable = ['nama','jumlah','keterangan'];
    public $timestamps = true;

    	public function Ekskul()
    	{
    		return $this ->hasOne('App\Ekskul','fasilitas_id');
    	}
}
