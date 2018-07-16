<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentType extends Model
{
    public $timestamps = false;
    protected $fillable = ['name'];
    
    public function payment()
    {
        return $this->hasMany('App\Payment');
    }
}
