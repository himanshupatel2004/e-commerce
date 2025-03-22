<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;


class HomeController extends Controller
{
    public function index(Request $request){

        $products = Product::all();
        $products_four = Product::paginate(4);


        if ($request->ajax() && $request->action == "search-product"){
            $products_four = Product::where('sub_category_id', $request->sub_cat_id)->paginate(4);

        }
        $data['subcategories'] = SubCategory::all();
        $data['products_four'] = $products_four;
        $data['products'] = $products;


        if ($request->ajax() && $request->action == "search-product"){
            return view('front_product')->with($data);
        }
        // dd($data);

        return view('index')->with($data);
    }

    public function shop(Request $request)
{
    $perpage = 6;
    $products = Product::paginate($perpage);
    if ($request->ajax()) {
        if($request->sub_cat_id){
            $where = [
                ['sub_category_id', $request->sub_cat_id],
            ];
            $products = Product::where($where)->paginate($perpage);
        }

        if($request->cat_id){
            $where = [
                ['category_id', $request->cat_id],
            ];
            $products = Product::where('category_id', $request->cat_id)->paginate($perpage);

        }

        if($request->range){
            $where = [
                ['price','<=', $request->range],
            ];
            $products = Product::where('price','<=', $request->range)->paginate($perpage);

        }
    }

    $data = [
        'categories'    => Category::all(),
        'subcategories' => SubCategory::all(),
        'products'      => $products,
        'perpage'       => $perpage,

    ];

    if ($request->ajax()){
        return view('shop_product')->with($data);
    }

    return view('shop', $data);
}


}
