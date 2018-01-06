<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Galery extends Model
{

    public function empresa(){
        return $this->belongsTo('App\Company','company_id');
    }

    public function getUrlAttribute(){
    	if(substr($this->image,0,4)==="http"){
    		return $this->image;
    	}
    	return '/imagenes/galeria/'.$this->image;
    }
}
