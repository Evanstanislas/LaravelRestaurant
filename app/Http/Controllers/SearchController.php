<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(){
        $result= Food::simplepaginate(6);
        return view('Food.search', compact('result'));
    }

    public function search(Request $request){
        $search = $request->input('query');
        $filter = $request->input('filter');

        if ($filter){
            $result= Food::where('name','LIKE','%'.$search.'%')
            ->whereIn('category', $filter)->simplepaginate(6);
        }
        else{
            $result= Food::where('name','LIKE','%'.$search.'%')
            ->simplepaginate(6);
        }
        return view('Food.search', compact('result'));
        }

    public function managesearch(Request $request){
        $search = $request->input('query');
        $filter = $request->input('filter');

        if ($filter){
            $foods= Food::where('name','LIKE','%'.$search.'%')
            ->whereIn('category', $filter)->get();
        }
        else{
            $foods= Food::where('name','LIKE','%'.$search.'%')->get();
        }

        return view('Food.manage',compact('foods'));
    }

    public function filter(Request $request){
        // ->whereIn('category', $request->filter);
    }
}
