<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TestProduct extends Model
{
    protected $fillable = ['title', 'description', 'price', 'availability'];
}
