<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'fecha', 'customer_id', 'total',
    ];

    public function cliente()
    {
        return $this->hasOne('App\Customer','id', 'customer_id');
    }


}
