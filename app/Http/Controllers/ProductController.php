<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Image;
use App\Category;
use Session;
use App\Product;
use App\ProductsAttribute;
use App\ProductImages;
use App\Coupon;
use App\User;
use Auth;
use App\Order;
use App\OrdersProduct;
use App\Country;
use App\DeliveryAddress;
use DB;

class ProductController extends Controller
{
    public function addProduct(Request $request){

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;
            if (empty($data['category_id'])) {
                return redirect()->back()->with('flash_message_error','Category Belum Dipilih');
            }
            $product = new Product;
            $product->category_id = $data['category_id'];
            $product->product_name = $data['product_name'];
            $product->product_color = $data['product_color'];
            $product->description = $data['description'];
            $product->description = $data['care'];
            $product->price = $data['price'];

            $selectedCat = DB::table('categories')->where(['id'=>$data['category_id']])->first();
            $lastIdProduct = Product::select('id')->orderBy('id','DESC')->first();
            $productCode = $selectedCat->category_code."0".($lastIdProduct->id + 1)."-".$data['product_color'];
            $product->product_code = $productCode;


            if ($request->hasFile('image')) {
                $img_tmp = Input::file('image');
                if ($img_tmp->isValid()) {
                    $extension = $img_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/products/large/'.$filename;
                    $medium_image_path = 'images/backend_images/products/medium/'.$filename;
                    $small_image_path = 'images/backend_images/products/small/'.$filename;
                    //Resize
                    Image::make($img_tmp)->resize(1200,1200)->save($large_image_path);
                    Image::make($img_tmp)->resize(600,600)->save($medium_image_path);
                    Image::make($img_tmp)->resize(300,300)->save($small_image_path);
                    //store image in product folder
                    $product->image = $filename;

                }
            }

            if(empty($data['status'])){
                $status = 0;
            }else{
                $status = 1;
            }

            $product->status = $status;
            $product->save();
            // return redirect()->back()->with('flash_message_success','Product Berhasil ditambah');
            return redirect('/admin/view-products')->with('flash_message_success','Product Berhasil ditambah');
        }

        $categories = Category::where(['parent_id'=>0])->get();
        $categories_dropdown = "<option value='' selected disabled>select</option>";
        foreach($categories as $cat){
            $categories_dropdown .= "<option value='".$cat->id."'>".$cat->name."</option>";
            $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
            foreach($sub_categories as $sub_cat){
                $categories_dropdown .= "<option value='".$sub_cat->id."'>&nbsp;--&nbsp;".$sub_cat->name."</option>";
            }
        }

        return view('admin.products.add_product')->with(compact('categories_dropdown'));
    }

    public function editProduct(Request $request,$id=null){


        if ($request->isMethod('post')) {
            $data = $request->all();

            if ($request->hasFile('image')) {
                $img_tmp = Input::file('image');
                if ($img_tmp->isValid()) {
                    $extension = $img_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/products/large/'.$filename;
                    $medium_image_path = 'images/backend_images/products/medium/'.$filename;
                    $small_image_path = 'images/backend_images/products/small/'.$filename;
                    //Resize
                    Image::make($img_tmp)->resize(1200,1200)->save($large_image_path);
                    Image::make($img_tmp)->resize(600,600)->save($medium_image_path);
                    Image::make($img_tmp)->resize(300,300)->save($small_image_path);

                }
            }else {
                $filename = $data['current_image'];
            }

            // echo "<pre>"; print_r($data); die;
            Product::where(['id'=>$id])->update(['category_id'=>$data['category_id'],
            'product_name'=>$data['product_name'],'product_code'=>$data['product_code'],'product_color'=>$data['product_color'],'description'=>$data['description'],'care'=>$data['care'],'price'=>$data['price'],'image'=>$filename]);

            return redirect()->back()->with('flash_message_success','Product Updated');
        }

        $productDetails = Product::where(['id'=>$id])->first();

        $categories = Category::where(['parent_id'=>0])->get();
        $categories_dropdown = "<option value='' selected disabled>select</option>";
        foreach($categories as $cat){
            if ($cat->id == $productDetails->category_id) {
                $selected = "selected";
            }else{
                $selected = "";
            }
            $categories_dropdown .= "<option value='".$cat->id."'".$selected.">".$cat->name."</option>";
            $sub_categories = Category::where(['parent_id'=>$cat->id])->get();
            foreach($sub_categories as $sub_cat){
                if ($sub_cat->id==$productDetails->category_id) {
                    $selected = "selected";
                }else{
                    $selected = "";
                }
                $categories_dropdown .= "<option value='".$sub_cat->id."'".$selected.">&nbsp;--&nbsp;".$sub_cat->name."</option>";
            }
        }

        return view('admin.products.edit_product')->with(compact('productDetails','categories_dropdown'));
    }

    public function viewProducts(){
        $products = Product::orderBy('id','DESC')->get();
        foreach($products as $product => $val){
            $category_name = Category::where(['id'=>$val->category_id])->first();
            $products[$product]->category_name = $category_name->name;
        }
        return view('admin.products.view_products')->with(compact('products'));
    }

    public function deleteProduct($id = null){
        Product::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Product Deleted Successfully');
    }

    public function deleteAltImage($id = null){

        $productImage = ProductImages::where(['id'=>$id])->first();

        $large_image_path = 'images/backend_images/products/large/';
        $medium_image_path = 'images/backend_images/products/medium/';
        $small_image_path = 'images/backend_images/products/small/';

        if (file_exists($large_image_path.$productImage->image)) {
            unlink($large_image_path.$productImage->image);
        }
        if (file_exists($medium_image_path.$productImage->image)) {
            unlink($medium_image_path.$productImage->image);
        }
        if (file_exists($small_image_path.$productImage->image)) {
            unlink($small_image_path.$productImage->image);
        }

        ProductImages::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Product Alternate Image Berhasil diHapus');
    }
    public function deleteProductImage($id = null){

        $productImage = Product::where(['id'=>$id])->first();

        $large_image_path = 'images/backend_images/products/large/';
        $medium_image_path = 'images/backend_images/products/medium/';
        $small_image_path = 'images/backend_images/products/small/';

        if (file_exists($large_image_path.$productImage->image)) {
            unlink($large_image_path.$productImage->image);
        }
        if (file_exists($medium_image_path.$productImage->image)) {
            unlink($medium_image_path.$productImage->image);
        }
        if (file_exists($small_image_path.$productImage->image)) {
            unlink($small_image_path.$productImage->image);
        }

        Product::where(['id'=>$id])->update(['image'=>'']);
        return redirect()->back()->with('flash_message_success','Product Image Berhasil diHapus');
    }

    public function addAttribute(Request $request,$id=null){
        $productDetails = Product::with('attributes')->where(['id'=>$id])->first();
        // echo "<pre>"; print_r($productDetails); die;

        if($request->isMethod('post')){
            $data = $request->all();
            foreach($data['sku'] as $key => $val){
                if (empty($val)) {

                    $val= $productDetails->product_code."-".$data['size'][$key];

                    $attrCountSku = ProductsAttribute::where(['sku'=>$val])->count();
                    if($attrCountSku>0){
                        return redirect('admin/add-attribute/'.$id)->with('flash_message_error', 'SKU Sudah Ada!');
                    }
                    $attrCountSizes = ProductsAttribute::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
                    if($attrCountSizes>0){
                        return redirect('admin/add-attribute/'.$id)->with('flash_message_error', 'Size Sudah Ada!');
                    }

                    $attribute = new ProductsAttribute;
                    $attribute->product_id = $id;
                    $attribute->sku = $val;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->save();
                }
            }
            return redirect('/admin/add-attribute/'.$id)->with('flash_message_success','Product Attributes Berhasil ditambah');
        }
        return view('admin.products.add_attribute')->with(compact('productDetails'));
    }

    public function editAttributes(Request $request,$id=null){
        
        if($request->isMethod('post')){
            $data = $request->all();
            foreach($data['idAttr'] as $key => $attr){
                ProductsAttribute::where(['id'=>$data['idAttr'][$key]])->update(['price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
            }
            
            return redirect()->back()->with('flash_message_success','Product Attributes Berhasil diubah');
    
        }

    }

    public function deleteAttribute($id = null){
        ProductsAttribute::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Attribute Berhasil Dihapus');
    }

    public function searchProducts(Request $request){

        $categories = Category::with('categories')->where(['parent_id'=>0])->get();

        if($request->isMethod('post')){
            $data = $request->all();
            $productsAll = Product::where('product_name','like','%'.$data['keyword'].'%')->get();
            return view('products.listing')->with(compact('productsAll','categories'));
        }
        
    }

    public function productsAll(){

        //show 404 when error
        $countCategory = Category::where(['status'=>1])->count();
        if($countCategory == 0){
            abort(404);
            // 503 for maintenance
        }

        $categories = Category::with('categories')->where(['parent_id'=>0])->get();


            $productsAll = Product::where('status',1)->get();

        $type = "all";

        
        // echo $categoryDetails->id;
        
        return view('products.listing')->with(compact('productsAll','categories','type'));
    }

    public function products($url = null){

        //show 404 when error
        $countCategory = Category::where(['url'=>$url,'status'=>1])->count();
        if($countCategory == 0){
            abort(404);
            // 503 for maintenance
        }

        $categories = Category::with('categories')->where(['parent_id'=>0])->get();

        $categoryDetails= Category::where(['url'=>$url])->first();

        if ($categoryDetails->parent_id == 0) {
            $subCategories = Category::where(['parent_id'=>$categoryDetails->id])->get();
            foreach($subCategories as $subcat){
                $cat_ids[] = $subcat->id;
            }
            $productsAll = Product::whereIn('category_id', $cat_ids)->where('status',1)->get();
        }else {
            $productsAll = Product::where(['category_id'=>$categoryDetails->id])->where('status',1)->get();
        }

        $type = "all";

        
        // echo $categoryDetails->id;
        
        return view('products.listing')->with(compact('categoryDetails','productsAll','categories','type'));
    }

    public function product($id = null){

        $productsCount = Product::where(['id'=>$id,'status'=>1])->count();
        if($productsCount == 0){
            abort(404);
        }

        $productDetails = Product::with('attributes')->where(['id'=>$id])->first();

        $categories = Category::with('categories')->where(['parent_id'=>0])->get();

        $relatedProducts = Product::where('id','!=',$id)->where(['category_id'=>$productDetails->category_id])->limit(4)->get();

        $productAltImages = ProductImages::where(['product_id'=>$id])->get();

        return view('products.detail')->with(compact('productDetails','categories','productAltImages','relatedProducts'));
    }

    public function getProductPrice(Request $request){
        $data = $request->all();

        $proArr = explode("-",$data['idsize']);
        $proAttr = ProductsAttribute::where(['product_id'=>$proArr[0],'size'=>$proArr[1]])->first();
        echo $proAttr->price;
    }

    public function getProductStock(Request $request){
        $data = $request->all();

        $proArr = explode("-",$data['idsize']);
        $proAttr = ProductsAttribute::where(['product_id'=>$proArr[0],'size'=>$proArr[1]])->first();
        echo $proAttr->stock;
    }

    public function addImages(Request $request, $id = null){
        $productDetails = Product::with('attributes')->where(['id'=>$id])->first();
        // echo "<pre>"; print_r($productDetails); die;

        if($request->isMethod('post')){

            $data = $request->all();
            // echo "<pre>"; print_r($data);die;
            if($request->hasFile('image')){
                $files = $request->file('image');

                foreach($files as $file){
                    $image = new ProductImages;
                    $extension = $file->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $large_image_path = 'images/backend_images/products/large/'.$filename;
                    $medium_image_path = 'images/backend_images/products/medium/'.$filename;
                    $small_image_path = 'images/backend_images/products/small/'.$filename;
                    Image::make($file)->resize(1200,1200)->save($large_image_path);
                    Image::make($file)->resize(600,600)->save($medium_image_path);
                    Image::make($file)->resize(300,300)->save($small_image_path);
                    $image->image = $filename;
                    $image->product_id = $data['product_id'];
                    $image->save();
                }
                return redirect('admin/add-images/'.$id)->with('flash_message_success', 'Product Image Berhasil Ditambah');
            }

        }
        
        $productImages = ProductImages::where(['product_id'=>$id])->get();

        return view('admin.products.add_images')->with(compact('productDetails','productImages'));
    }

    public function addtocart(Request $request){
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        $data = $request->all();
        // echo "<pre>"; print_r($data); die;

        $sizeArr = explode("-",$data['size']);
        if(!empty(Auth::user()->email)){
            $data['user_email'] = Auth::user()->email;
        }else{
            $data['user_email'] = '';
        }

        $session_id = Session::get('session_id');
        if(empty($session_id)){
            $session_id = str_random(40);
            Session::put('session_id',$session_id);
        }

        $countProducts = DB::table('cart')->where(['product_id'=>$data['product_id'],'product_color'=>$data['product_color'],'size'=>$sizeArr[1],'session_id'=>$session_id])->count();

        // echo $countProducts; die;  

        if($countProducts>0){
            return redirect()->back()->with('flash_message_error','Product Sudah Ada Dalam Cart');
        }else{

            $getSKU = ProductsAttribute::select('sku')->where(['product_id'=>$data['product_id'],'size'=>$sizeArr[1]])->first();


            $getStock = DB::table('products_attributes')->where(['product_id'=>$sizeArr[0],'size'=>$sizeArr[1]])->first();

            if($getStock->stock < $data['quantity']){
                return redirect()->back()->with('flash_message_error','Harap Kurangi Stock Sesuai Ketersediaan Kami');
            }

            DB::table('cart')->insert(['product_id'=>$data['product_id'],'product_name'=>$data['product_name'],'product_code'=>$getSKU->sku,'product_color'=>$data['product_color'],'price'=>$data['price'],'size'=>$sizeArr[1],'quantity'=>$data['quantity'],'user_email'=>$data['user_email'],'session_id'=>$session_id]);
        }

        return redirect('cart')->with('flash_message_success','Product Berhasil Masuk Cart');
    }

    public function cart(){
        // Session::forget('CouponAmount');
        // Session::forget('CouponCode');
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

        $categories = Category::with('categories')->where(['parent_id'=>0])->get();


        return view('products.cart')->with(compact('userCart','categories'));
    }

    public function deleteCartProduct($id = null){
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        DB::table('cart')->where('id',$id)->delete();
        return redirect('cart')->with('flash_message_success','Product Berhasil dihapus dari Cart');
    }

    public function updateCartQuantity($id=null,$quantity = null){

        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        $getCartDetails = DB::table('cart')->where(['id'=>$id])->first();
        $getAttributeStock = ProductsAttribute::where(['sku'=>$getCartDetails->product_code])->first();
        echo $getAttributeStock->stock; echo"--";
        $updated_quantity = $getCartDetails->quantity+$quantity;

        if($getAttributeStock->stock >= $updated_quantity){
            DB::table('cart')->where('id',$id)->increment('quantity',$quantity);
            return redirect('cart')->with('flash_message_success','Product Quanitity Berhasil Diubah');
        }else{
            return redirect('cart')->with('flash_message_error','Jumlah Barang Anda Tidak Tersedia');
        }

        
    }

    public function applyCoupon(Request $request){

        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        
        $data = $request->all();
        $couponCount = Coupon::where('coupon_code',$data['coupon_code'])->count();
        if($couponCount == 0){
            return redirect()->back()->with('flash_message_error','Coupon Tidak Ada');
        }else{
            // echo "success";
            $couponDetails = Coupon::where('coupon_code',$data['coupon_code'])->first();

            if($couponDetails->status==0){
                return redirect()->back()->with('flash_message_error','Coupon Sudah Tidak Aktif');
            }

            $expiry_date = $couponDetails->expiry_date;
            $current_date = date('Y-m-d');
            if($expiry_date< $current_date){
                return redirect()->back()->with('flash_message_error','Masa Berlaku Coupon Telah Habis');
            }

            $session_id = Session::get('session_id');
            if (Auth::check()) {
                $user_email = Auth::user()->email;
                $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();
            }else{
                
                $userCart = DB::table('cart')->where(['session_id'=>$session_id])->get();
            }

            $total_amount = 0;
            foreach($userCart as $item){
                $total_amount = $total_amount + ($item->price * $item->quantity);
            }

            foreach($userCart as $key => $product){
                $productDetails = Product::where(['id'=>$product->product_id])->first();
                $userCart[$key]->image = $productDetails->image;
            }

            if($couponDetails->amount_type=="Fixed"){
                $couponAmount = $couponDetails->amount;
            }else{
                $couponAmount = $total_amount * ($couponDetails->amount/100);
            }

            // echo $couponAmount;

            Session::put('CouponAmount',$couponAmount);
            Session::put('CouponCode',$data['coupon_code']);

            return redirect()->back()->with('flash_message_success','Coupon Berhasil Digunakan');

        }
        // echo $data; die;
    }

    public function checkout(Request $request){
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        $user_email = Auth::user()->email;
        $userDetails = User::find(Auth::user()->id);
        $countries = Country::get();

        $shippingCount = DeliveryAddress::where('user_id',Auth::user()->id)->count();
        if($shippingCount>0){
            $shippingDetails = DeliveryAddress::where('user_id',Auth::user()->id)->first();
        }else{
            $shippingDetails = new DeliveryAddress;
            $shippingDetails->name = '';
            $shippingDetails->address = '';
            $shippingDetails->city = '';
            $shippingDetails->state = '';
            $shippingDetails->country = '';
            $shippingDetails->zipcode = '';
            $shippingDetails->mobile = '';
        }

        $session_id = Session::get('session_id');
        DB::table('cart')->where(['session_id'=>$session_id])->update(['user_email'=>$user_email]);

        if($request->isMethod('post')){
            $data = $request->all();
            User::where('id',Auth::user()->id)->update(['name'=>$data['billing_name'],'address'=>$data['billing_address'],'city'=>$data['billing_city'],'state'=>$data['billing_state'],'country'=>$data['billing_country'],'zipcode'=>$data['billing_zipcode'],'mobile'=>$data['billing_mobile']]);

            if($shippingCount>0){
                DeliveryAddress::where('user_id',Auth::user()->id)->update(['name'=>$data['shipping_name'],'address'=>$data['shipping_address'],'city'=>$data['shipping_city'],'state'=>$data['shipping_state'],'country'=>$data['shipping_country'],'zipcode'=>$data['shipping_zipcode'],'mobile'=>$data['shipping_mobile']]);
            }else{
                $shipping = new DeliveryAddress;
                $shipping->user_id = Auth::user()->id;
                $shipping->user_email = Auth::user()->email;
                $shipping->name = $data['shipping_name'];
                $shipping->address = $data['shipping_address'];
                $shipping->city = $data['shipping_city'];
                $shipping->state = $data['shipping_state'];
                $shipping->country = $data['shipping_country'];
                $shipping->zipcode = $data['shipping_zipcode'];
                $shipping->mobile = $data['shipping_mobile'];
                $shipping->save();
            }

            return redirect()->action('ProductController@orderReview');
        }

        return view('products.checkout')->with(compact('categories','userDetails','countries','shippingDetails'));
    }

    public function orderReview(){
        $user_id = Auth::user()->id;
        $user_email = Auth::user()->email;
        $userDetails = User::where('id',$user_id)->first();
        $shippingDetails = DeliveryAddress::where('user_id',Auth::user()->id)->first();
        $countries = Country::get();
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();

        $userCart = DB::table('cart')->where(['user_email'=>$user_email])->get();

        foreach($userCart as $key => $product){
            $productDetails = Product::where(['id'=>$product->product_id])->first();
            $userCart[$key]->image = $productDetails->image;
        }

        return view('products.order_review')->with(compact('userDetails','shippingDetails','categories','countries','userCart'));
    }

    public function placeOrder(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            // print_r($data);die;
            $user_email = Auth::user()->email;
            $user_id = Auth::user()->id;

            $shippingDetails = DeliveryAddress::where(['user_email'=>$user_email])->first();

            if (!Session::has('CouponCode')) {
                $coupon_code = '';
            }else{
                $coupon_code = Session::get('CouponCode');
            }
            if (!Session::has('CouponAmount')) {
                $coupon_amount = '';
            }else{
                $coupon_amount = Session::get('CouponAmount');
            }

            $order = new Order;
            $order->user_id = $user_id;
            $order->user_email = $user_email;
            $order->name = $shippingDetails->name;
            $order->address = $shippingDetails->address;
            $order->city = $shippingDetails->city;
            $order->state = $shippingDetails->state;
            $order->country = $shippingDetails->country;
            $order->zipcode = $shippingDetails->zipcode;
            $order->mobile = $shippingDetails->mobile;
            $order->coupon_code = $coupon_code;
            $order->coupon_amount = $coupon_amount;
            $order->order_status = "New";
            $order->payment_method = $data['payments'];
            $order->grand_total = $data['grand_total'];
            $order->save();

            $order_id = DB::getPdo()->lastInsertId();

            $cartProducts = DB::table('cart')->where(['user_email'=>$user_email])->get();
            foreach($cartProducts as $product){
                $cartProcuct = new OrdersProduct;
                $cartProcuct->order_id = $order_id;
                $cartProcuct->user_id = $user_id;
                $cartProcuct->product_id = $product->product_id;
                $cartProcuct->product_code = $product->product_code;
                $cartProcuct->product_name = $product->product_name;
                $cartProcuct->product_color = $product->product_color;
                $cartProcuct->product_size = $product->size;
                $cartProcuct->product_price = $product->price;
                $cartProcuct->product_qty = $product->quantity;
                $cartProcuct->save();

                $proAtt = DB::table('products_attributes')->where(['product_id'=>$product->product_id,'size'=>$product->size])->first();
                ProductsAttribute::where('id',$proAtt->id)->update(['stock'=>($proAtt->stock - $product->quantity)]);


            }
            Session::put('order_id',$order_id);
            Session::put('grand_total',$data['grand_total']);



            return redirect('thanks');
        }
    }
    public function thanks(Request $request){
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();

        $user_email = Auth::user()->email;
        DB::table('cart')->where('user_email',$user_email)->delete();

        return view('products.thanks')->with(compact('categories'));
    }

    public function userOrders(){
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        $user_id = Auth::user()->id;
        $orders = Order::with('orders')->where('user_id',$user_id)->orderBy('id','Desc')->get();

        return view('orders.user_orders')->with(compact('categories','orders'));
    }

    public function userOrderDetails($order_id){
        $categories = Category::with('categories')->where(['parent_id'=>0])->get();
        $user_id = Auth::user()->id;
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        return view('orders.user_order_details')->with(compact('orderDetails','categories'));
    }

    public function viewOrders(){
        $orders = Order::with('orders')->orderBy('id','Desc')->get();
        return view('admin.orders.view_orders')->with(compact('orders'));
    }

    public function viewOrderDetails($order_id){
        $orderDetails = Order::with('orders')->where('id',$order_id)->first();
        $user_id = $orderDetails->user_id;
        $userDetails = User::where('id',$user_id)->first();
        return view('admin.orders.order_details')->with(compact('orderDetails','userDetails'));
    }

    public function updateOrderStatus(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            Order::where('id',$data['order_id'])->update(['order_status'=>$data['order_status']]);
            return redirect()->back()->with('flash_message_success','Status Order Behasil diubah');
        }
    }

}
