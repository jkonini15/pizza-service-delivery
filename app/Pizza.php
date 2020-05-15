<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Pizza extends Model
{
    use SoftDeletes;

    private $id;

    protected $fillable = [
        'name', 'price_small', 'price_medium', 'price_large', 'image', 'description'
    ];

    protected $table = 'pizzas';

    protected $dates = ['deleted_at'];

    public function orders()
    {
        return $this->belongsToMany('App\Orders');
    }

}
