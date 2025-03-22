<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\User;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;




class ProductController extends Controller
{
    public function index(){
        $products = Product::paginate(10);
        return view('admin-panel.products.list', compact('products'));
    }

    public function create(){

        $categories = Category::all();
        $sub_categories = SubCategory::all();
        return view('admin-panel.products.create',compact('categories','sub_categories'));
    }

    public function store(Request $request) {
        if($request->file('image')){
            $image = $request->file('image');
            $img_name = time().rand(10000,99999).$image->getClientOriginalName();
            $image->move('uploads/products/', $img_name);
            $img_name = 'uploads/products/'. $img_name;
        }
        $product = new Product();
        $product->title = $request->title;
        $product->price = $request->price;
        $product->discount_price = $request->discount_price;
        $product->description = $request->description;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->sub_category_id;
        $product->image = $img_name ?? null;
        $product->save();
        return redirect('products/list');
    }

    public function cart(Request $request){

        $cart_prods =  Cart::where('user_id', Auth::id())->get();

        return view('cart', compact('cart_prods'));
    }

    public function checkout(Request $request){

        $cart_prods =  Cart::where('user_id', Auth::id())->where('quantity','!=',0)->get();
        $total_payout = 0;
        foreach ($cart_prods as $cart){
           $total_payout = $total_payout + ($cart->quantity * $cart->product->discount_price);
        }
        return view('checkout', compact('cart_prods', 'total_payout'));
    }

    public function addCart(Request $request){

        $cart =  Cart::where('user_id', Auth::id())->where('product_id',$request->prod_id)->first();
        if(!$cart){
            $cart = new Cart();
            $cart->product_id = $request->prod_id;
            $cart->user_id = Auth::id();
            $cart->save();
        }
        $cart_count = Cart::where('user_id', Auth::id())->count();

        return response()->json(['success'=> true, 'cart_count'=> $cart_count, 'message' => 'Product added to cart successfully']);
    }

    public function updateCart(Request $request){

        $cart =  Cart::find($request->cart_id);

            $cart->quantity = $request->quantity;
            $cart->save();

        $cart_count = Cart::where('user_id', Auth::id())->count();

        return response()->json(['success'=> true, 'cart_count'=> $cart_count]);
    }

    public function removeCart(Request $request){

        $cart =  Cart::find($request->cart_id);

        $cart->delete();

        $cart_count = Cart::where('user_id', Auth::id())->count();

        return response()->json(['success'=> true, 'cart_count'=> $cart_count]);
    }

    public function totalPayout(Request $request){

        $carts = Cart::where('user_id', Auth::id())->get();

        $total_payout = 0;
        foreach ($carts as $cart){
           $total_payout = $total_payout + ($cart->quantity * $cart->product->discount_price);
        }

        return response()->json(['success'=> true, 'total_payout'=> $total_payout]);
    }

    public function edit($id)
{
    $product = Product::findOrFail($id); // Use findOrFail to handle non-existing IDs
    return view('products.edit', compact('product'));

}

public function update(Request $request, $id)
{
    $product = Product::findOrFail($id); // Use the ID from the route

    $imagePaths = [];

    if ($request->hasFile('images')) {
        // Delete old images
        $oldImages = json_decode($product->image, true) ?? [];
        foreach ($oldImages as $image) {
            if (file_exists(public_path($image))) {
                unlink(public_path($image));
            }
        }
    

        // Upload new images
        foreach ($request->file('images') as $image) {
            $imgName = time() . rand(100000, 999999) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imgName);
            $imagePaths[] = 'images/' . $imgName;
        }
    }

    // Update product details
    $product->title = $request->title;
    $product->price = $request->price;
    $product->discount_price = $request->discount_price;
    $product->description = $request->description;
    $product->category_id = $request->category_id;
    $product->sub_category_id = $request->sub_category_id;
    $product->image = !empty($imagePaths) ? json_encode($imagePaths) : $product->image;
    $product->save();

    return redirect()->route('products.list')->with('success', 'Product updated successfully');
}


public function delete($id)
{
    $product = Product::findOrFail($id);

    // Delete images
    $images = json_decode($product->image, true) ?? [];
    foreach ($images as $image) {
        if (file_exists(public_path($image))) {
            unlink(public_path($image));
        }
    }
    $product->delete();
    return back()->with('success', 'Product deleted successfully');
}

public function show($id)
{
    $product = Product::findOrFail($id);
    return view('products.show', compact('product'));
}


}
