<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $casts = [
        'transaction_id' => 'string'
    ];
    
    protected $fillable = [
        'transaction_id', 'user_id', 'pizza_id', 'qty', 'created_at'
    ];

    public function pizza()
    {
        return $this->belongsTo("App\Pizza");
    }

    public function user()
    {
        return $this->belongsTo("App\User");
    }
}
