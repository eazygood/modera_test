<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Category extends Model
{
    //
    public $timestamps = false;
    protected $primaryKey = 'id';
    protected $table = 'categories';
    protected $fillable = ['parent_id', 'name'];

    public function subcategory() {
    	return $this->hasOne('App\Category','parent_id', 'id');
    }
}
