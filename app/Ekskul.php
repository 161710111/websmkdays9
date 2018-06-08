<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ekskul extends Model
{
    protected $table = 'ekskuls';
    protected $fillable = ['nama','keterangan','fasilitas_id','prestasi_id'];
    public $timestamps = true;

    	public function Fasilitas()
    	{
    		return $this ->belongsTo('App\Fasilitas','fasilitas_id');
    	}
    		public function Prestasi()
    		{
    			return $this ->belongsTo('App\Prestasi','prestasi_id');
    		}
}
