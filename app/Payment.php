<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    //
    protected $fillable = [
        'user_id',
        'payment_category_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
