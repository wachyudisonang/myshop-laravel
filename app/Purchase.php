<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    // https://laravel.com/docs/5.6/eloquent#inserting-and-updating-models
	// protected $table = 'purchase';
	public $timestamps = false;
	protected $fillable = ['product_id', 'unit_price', 'qty', 'payment_id'];

	/**
     * Get the product.
     */
    public function product()
    {
        return $this->belongsTo('App\Product');
	}
	
	public function payment()
    {
        return $this->belongsTo('App\Payment');
    }
}
