<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Category;
use Auth;
use App\Cart;
use Session;
use DB;
use App\Product;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public static function allCategories(){
        $allCategories = Category::where(['status'=>1])->get();
        return $allCategories;
    }
    public static function mainCategories(){
        $mainCategories = Category::where(['parent_id'=>0,'status'=>1])->get();
        
        return $mainCategories;
    }

    public static function userCart(){
        if (Auth::check()) {
            $user_email = Auth::user()->email;
            $session_id = Session::get('session_id');
            $userCart = DB::table('cart')->where(['user_email'=>$user_email])->orWhere(['session_id'=>$session_id])->get();
        }else{
            $session_id = Session::get('session_id');
            $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
        }

        foreach($userCart as $key => $product){
            $productDetails = Product::where(['id'=>$product->product_id])->first();
            $userCart[$key]->image = $productDetails->image;
        }

        return $userCart;
    }

    public static function cartCount(){
        if (Auth::check()) {
            $user_email = Auth::user()->email;
            $session_id = Session::get('session_id');
            $cartCount = DB::table('cart')->where(['user_email'=>$user_email])->orWhere(['session_id'=>$session_id])->count();
        }else{
            $session_id = Session::get('session_id');
            $cartCount = DB::table('cart')->where(['session_id'=>$session_id])->count();
        }

        return $cartCount;
    }
    

}
