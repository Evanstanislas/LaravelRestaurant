<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Summary of Food
 */
class Food extends Model
{
    use HasFactory;

    /**
     * Summary of primary
     * @var string
     */
    protected $primary= 'id';

    /**
     * Summary of fillable
     * @var array
     */
    protected $fillable= [
        'name',
        'brief',
        'detail',
        'category',
        'price',
        'picture',
    ];

    public function transactions()
    {
        return $this->belongsToMany(Transaction::class, 'food_transaction', 'food_id', 'transaction_id');
    }

    public function carts(){
        return $this->belongsToMany(Cart::class, 'food_cart', 'food_id', 'carts_id');
    }


}
