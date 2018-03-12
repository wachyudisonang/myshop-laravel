<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable = ['Name', 'Variant', 'PackSize', 'Key', 'CategoryID', 'UnitID'];
    
    /**
     * Get the product category.
     */
    public function category()
    {
        return $this->belongsTo('App\ProductCategory');
    }
    
}
