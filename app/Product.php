<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable = ['name', 'pack_size', 'category_id', 'unit_id'];
    
    /**
     * Get the product category.
     */
    public function category()
    {
        return $this->belongsTo('App\ProductCategory');
    }
	
	public function purchases()
    {
        return $this->hasMany('App\Purchase');
    }
}
