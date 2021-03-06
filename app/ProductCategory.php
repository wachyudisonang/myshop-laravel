<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
    
    /**
     * Get the products.
     */
    public function product()
    {
        return $this->hasMany('App\Product');
    }
}
