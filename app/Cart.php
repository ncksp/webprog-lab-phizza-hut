<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
//kalo udah banyak modelnya dipindahin ke folder Models, tapi ini masih sedikit
class Cart extends Model
{
    protected $fillable = [
        'user_id', 'pizza_id', 'qty'
    ];

    public function pizza(){
        return $this->belongsTo("App\Pizza");
    }

    public function user()
    {
        return $this->belongsTo("App\User");
    }
}
