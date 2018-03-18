<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    
    public function empresa(){
        return $this->belongsTo('App\Company','company_id');
    }

    public function getUrlAttribute(){
    	if(substr($this->document,0,4)==="http"){
    		return $this->document;
    	}
    	return '/archivos/'.$this->document;
    }

}
