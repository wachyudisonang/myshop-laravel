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
        return $this->hasOne('App\Purchase');
    }
}
