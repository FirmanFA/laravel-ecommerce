<?php

namespace App\Http\Controllers;
use App\Product;
use App\Category;
use App\Banner;

use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index(){
        //order by id desc
        $productsAll = Product::orderBy('id','DESC')->where('status',1)->get();
        //order by default
        // $productsAll = Product::get();
        //order by random
        // $productsAll = Product::inRandomOrder()->get();

        //get Category
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        $banners = Banner::where('status','1')->get();
        // echo "<pre>"; print_r($categories); die;

        // $categories_menu = "";
        
        // foreach($categories as $cat){
        //     echo $cat->name;
        //     $categories_menu .= "<li class='dropdown side-dropdown'>
        //     <a class='dropdown-toggle' data-toggle='dropdown' aria-expanded='true'>".$cat->name." <i class='fa fa-angle-right'></i></a>
        //     <div class='custom-menu' style='width:50%;'>
        //         <div class='row'>
        //             <div class='col-md-4'>
        //                 <ul class='list-links'>
        //                 <li>
        //                 <h3 class='list-links-title'>Categories</h3></li>
        //                 <li><a href='#".$cat->url."'>".$cat->name."</a></li>";
        //                 $sub_category = Category::where(['parent_id'=>$cat->id])->get();
        //                 foreach($sub_category as $sub){
        //                     echo $sub->name;
        //                     $categories_menu .= "<li><a href='#".$sub->id."'>".$sub->name."</a></li>";
        //                 }
        //      $categories_menu .="</ul>
        //                 <hr class='hidden-md hidden-lg'>
        //             </div>
        //         </div>
        //     </div>
        // </li>";
        // }
        return view('index')->with(compact('productsAll','categories_menu','categories','banners'));
    }
}
