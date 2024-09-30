<?php

namespace App\Http\Controllers;
use App\Models\Cart;


use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function checkout(){
        return view('transaction.checkout');
    }

    public function AddTransaction(Request $request){

        $validation=[
            'fullname' => 'required|string|min:5',
            'phonenumber'=> 'size:12|required',
            'address'=> 'min:5|required',
            'city'=> 'min:5|required',
            'cardname'=> 'min:3|required',
            'cardnumber'=> 'size:16|required',
            'country'=>'required',
            'zip'=>'numeric|required',
        ];

        $validator= Validator::make($request->all(), $validation);

        if($validator->fails()){
            return back()->withErrors($validator);
        }


        $user= Auth::user();
        $userid= $user->id;
        $id = Transaction::generateID();
        $currentDate = date('Y-m-d');
        $receipt= '';
        $cart= Cart::all();
        foreach ($cart as $item) {
            $receipt .=$item->getReceipt(). ", ";
        }
        $receipt = rtrim($receipt, ", ");

        DB::table('transactions')->insert([
            'transactions_id'=>$id,
            'fullname'=>$request->fullname,
            'phonenumber'=>$request->phonenumber,
            'address'=>$request->address,
            'city'=>$request->city,
            'cardname'=>$request->cardname,
            'cardnumber'=>$request->cardnumber,
            'country'=>$request->country,
            'zip'=>$request->zip,
            'user_id'=>$userid,
            'receipt'=>$receipt,
            'date'=>$currentDate,
            'total'=>$cart->sum('total')
        ]);

        DB::table('carts')->truncate();

        return redirect('/')->with('success', 'Transaction Success!');
    }

    public function history(){
        $user= Auth::user();
        $userid= $user->id;
        $Transaction= DB::table('transactions')
        ->where('user_id', '=', $userid)
        ->get();
        return view("transaction.history", compact('Transaction'));
    }

    

}
