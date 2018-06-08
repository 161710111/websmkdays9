<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prestasi extends Model
{
    protected $table = 'prestasis';
    protected $fillable = ['nama','perolehan'];
    public $timestamps = true;

    	public function Ekskul()
    	{
    		return $this ->hasMany('App\Ekskul','prestasi_id');
    	}

}
