<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public $timestamps = false;
	protected $fillable = ['amount', 'store_id', 'date', 'type_id', 'bank_id', 'instalment', 'trx_code'];

	/**
     * Get the product.
     */
    public function purchase()
    {
        return $this->hasMany('App\Purchase');
    }

    public function store()
    {
        return $this->belongsTo('App\Store');
    }
    
    public function type()
    {
        return $this->belongsTo('App\PaymentType');
    }

    public function bank()
    {
        return $this->belongsTo('App\Bank');
    }

    
}
