<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $primary='transactions_id';

    protected $fillable=[
        'receipt',
        'date',
        'total',
        'fullname',
        'phonenumber',
        'address',
        'city',
        'cardname',
        'cardnumber',
        'country',
        'zip'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }
    
    public function foods()
    {
        return $this->belongsToMany(Food::class, 'food_transaction', 'transaction_id', 'food_id');
    }

    public static function generateID()
{
    $allIds = self::pluck('transactions_id');

    $highestNumber = 0;
    foreach ($allIds as $id) {
        $number = (int) str_replace('TR', '', $id);
        if ($number > $highestNumber) {
            $highestNumber = $number;
        }
    }

    $number = $highestNumber + 1;
    $formattedNumber = str_pad($number, 3, '0', STR_PAD_LEFT);
    $newId = "TR{$formattedNumber}";

    return $newId;
}


}
