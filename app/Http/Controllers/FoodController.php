<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FoodController extends Controller
{
    /**
     * Summary of index
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function homepage(){
        $category= '';
        $foods= Food::simplepaginate(6);
        return view('home', compact('foods', 'category'));
    }

    /**
     * Summary of detail
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function detail(Request $request){
        $item= $request->id;
        $food= Food::find($item);
        return view('Food.detail', compact('food'));

        }

    /**
     * Summary of categoryfilter
     * @param \Illuminate\Support\Facades\Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function categoryfilter(Request $request){
        $category = $request->input('category');

        $query = Food::query();

        switch ($category) {
            case 'maincourse':
                $query->where('category', 'LIKE', 'Main Course');
                break;
            case 'beverages':
                $query->where('category', 'LIKE', 'Beverages');
                break;
            case 'desserts':
                $query->where('category', 'LIKE', 'Desserts');
                break;
            default:
                $query = Food::query();
        }

        $foods = $query->paginate(6);
        return view('home', compact('foods', 'category'));

    }

    public function addindex(){
        return view('Food.add');
    }

    public function addfood(Request $request){

        $validation= [
            'name'=> 'required|min:5',
            'brief'=>'required|max:100',
            'detail'=>'required|max:255',
            'price'=>'required|min:0',
            'picture'=>'mimes:jpg,jpeg,png'
        ];

        $validator= Validator::make($request->all(), $validation);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $file= $request-> file('picture');
        $image_name= time().'.'.$file->getClientOriginalExtension();
        Storage::putFileAs("public/images", $file, $image_name);
        $image_url= $image_name;

        DB::table('food')->insert([
            'name'=> $request->name,
            'brief'=> $request->brief,
            'detail'=> $request->detail,
            'category'=> $request->category,
            'price'=> $request->price,
            'picture'=>$image_url
        ]);
        return redirect('/')->with('success', 'Food is Successfully added');
    }

    public function manageindex(){
        $foods = Food::all();
        return view('Food.manage', compact('foods'));
    }

    public function update(Request $request){
        $item= $request->id;
        $food= Food::find($item);
        return view('Food.update', compact('food'));
        }

    public function updatefood(Request $request){
        $validation= [
            'name'=> 'required|min:5',
            'brief'=>'required|max:100',
            'detail'=>'required|max:255',
            'price'=>'required|min:0',
            'picture'=>'mimes:jpg,jpeg,png'
        ];

        $validator= Validator::make($request->all(), $validation);

        if($validator->fails()){
            return back()->withErrors($validator);
        }

        $file= $request->file('picture');
        $image_name= time().'.'.$file->getClientOriginalExtension();
        Storage::putFileAs("public/images", $file, $image_name);
        $image_url= $image_name;
        $result= $request->id;

        DB::table('food')->where('id', '=', $result)
        ->update([
            'name'=> $request->name,
            'brief'=> $request->brief,
            'detail'=> $request->detail,
            'category'=> $request->category,
            'price'=> $request->price,
            'picture'=>$image_url
        ]);
        return redirect('/')->with('success', 'Food has been Updated');
    }

    public function delete(Request $request){
        $result= $request-> id;
        DB::table('food')
            -> where('id', '=', $result)
            ->delete();
        return redirect('/managefood')->with('success', 'Food is Deleted');
    }

}
