<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Model
{
    //
    use SoftDeletes;

    private $id;

    protected $dates = ['deleted_at'];

    protected $fillable=[
        'users','pizzas'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function pizzas()
    {
        return $this->belongsToMany('App\Pizzas')->withPivot('quantity','size');
    }

}
