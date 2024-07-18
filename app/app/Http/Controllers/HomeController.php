<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Sale;

use App\Models\Product;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use Illuminate\Validation\Rule;

class HomeController extends Controller
{
    //
    public function welcome(){
        return view('welcome');
    }

    public function sign_in(){
        return view('signin');
    }

    public function dashboard(){
        $profit = Sale::sum('price');
        return view('dashboard',[
            'sales' => Sale::latest()->filter(request(['search']))->paginate(10),
            'products' => Product::all(),
        ],compact('profit'));
    }

    public function store_sales(Request $request){
        $salesDetails = $request->validate([
            'product_id' => 'required',
            'product_name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'brand' => 'required',
            // 'image' => 'nullable',
        ]);
        // if($request->hasFile('image')){
        //     $salesDetails['image'] = $request->file('image')->store('images','public');
        // }

        $product = Product::where('product_id' , $salesDetails['product_id'])->first();

        if($product->quantity < $salesDetails['quantity']){
            return redirect()->back()->with('not_enough', 'Product not enough!');
        }

        $product->quantity -= $salesDetails['quantity'];

        $product->save();

        Sale::create($salesDetails);

        return redirect()->back()->with('sold_success','Product sold successfully!');

    }

    public function single_product($id){
        return view('single-product',[
            'sale' => Sale::single($id),
            'products' => Product::all(),    
        ]);
    }

    public function delete_sale_record(Request $request, Sale $sale){
        $sale->delete();
        return redirect('/dashboard')->with('sale_deleted','Sale record deleted successfully!');
    }

    public function edit_sale(Request $request, Sale $sale){
        $saleEditDetails = $request->validate([
            'product_id' => 'required',
            'product_name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'brand' => 'required',
            'image' => 'nullable',
        ]);

        if($request->hasFile('image')){
            $salesDetails['image'] = $request->file('image')->store('images','public');
        }

        $sale->update($saleEditDetails);

        return redirect()->back()->with('edited_sale_record','Sale detail updated succesfully!');
    }

    public function authentication(Request $request){
        $loginCred = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if(Auth::guard('web')->attempt($loginCred)){
            $request->session()->regenerateToken();
            return redirect('/')->with('success_login','Logged in successfully!');
        }else{
            return redirect()->back()->with('fail_login','Incorrect username or password!');
        }
    }

    public function invalidate(Request $request){
        $request->session()->invalidate();
        return redirect('/')->with('success_logout','Logged out successfully!');
    }

    public function import_product(){

        $products = DB::table('products')->select('quantity')->groupBy('quantity')->get();

        foreach ($products as $product) {
            if($product->quantity < 20){
                Product::where('quantity', $product->quantity)->update(['status' => 'Less']);
            }else{
                Product::where('quantity', $product->quantity)->update(['status' => 'Good']);
            }
        }

        return view('import-product',[
            'products' => Product::latest()->filter(request(['search']))->paginate(10),
        ]);
    }

    public function store_products(Request $request){
        $productDetails = $request->validate([
            'product_id' => 'required|max:255',
            'product_name' => 'required|max:255',
            'quantity' => 'required|integer',
            'description' => 'required|max:255',
            'price' => 'required|numeric',
            'brand' => 'required',
            'image' => 'required|image|max:2048',
        ]);

        if($request->hasFile('image')){
            $productDetails['image'] = $request->file('image')->store('products','public');
        }

        $existingProduct = Product::where('product_id', $request->input('product_id'))->first();

        if($existingProduct){
            return redirect()->back()->with('exists','Product exists!');
        }

        Product::create($productDetails);

        return redirect()->back()->with('success_product_added','Product added successfully!');
    }

    public function single_import_product($id){
        return view('single-import',[
            'product' => Product::find($id),
        ]);
    }

    function delete_product(Request $request, Product $product){
        $product->delete();
        return redirect('/import-product')->with('success_delete','Product deleted successfully!');
    }
}
