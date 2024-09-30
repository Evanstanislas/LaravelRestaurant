<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;

class CartController extends Controller
{
    public function index(){
        $Cart= Cart::all();
        $totalPrice = Cart::all()->sum('total');
        return view('transaction.cart', compact('Cart', 'totalPrice'));
    }

    public function AddCart(Request $request){
        $item= $request->id;
        $food= Food::find($item);
        $cart_id=DB::table('carts')->insertGetId([
            'food'=> $food->name,
            'price'=> $food->price,
            'quantity'=>1,
            'total'=>$food->price*1,
        ]);
        return redirect()->route('detail',['id' => $food->id])->with('success', 'Item Successfully added');
    }

    public function RemoveCart(Request $request){
        $result= $request->id;
        DB::table('carts')
            -> where('id', '=', $result)
            ->delete();
        return redirect('/cart')->with('success', 'Item Successfully removed');
    }

    public function AddQuantity(Request $request){
        $result= $request->id;
        DB::table('carts')
        -> where('id', '=', $result)
        ->increment('quantity');
        $cart= Cart::find($result);
        DB::table('carts')
        -> where('id', '=', $result)
        ->update([
            'total'=>$cart->price*$cart->quantity
        ]);
        return redirect('/cart');
    }

    public function MinusQuantity(Request $request){
        $result= $request->id;
        DB::table('carts')
        -> where('id', '=', $result)
        ->decrement('quantity');
        $cart= Cart::find($result);
        if($cart->quantity==0){
            DB::table('carts')
            -> where('id', '=', $result)
            ->delete();
            return redirect('/cart')->with('success', 'Item Successfully removed');
        }
        else{
            DB::table('carts')
            -> where('id', '=', $result)
            ->update([
                'total'=>$cart->price*$cart->quantity
            ]);
        }
        return redirect('/cart');
    }

}
