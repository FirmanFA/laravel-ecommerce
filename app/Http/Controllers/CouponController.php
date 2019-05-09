<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Coupon;

class CouponController extends Controller
{
    public function addCoupon(Request $request){

        if($request->isMethod('post')){
            $data = $request->all();
            $coupon = new Coupon;
            $coupon->coupon_code = $data['coupon_code'];
            $coupon->amount = $data['amount'];
            $coupon->amount_type = $data['amount_type'];
            $coupon->expiry_date = $data['expiry_date'];
            if (empty($data['status'])) {
                $coupon->status = '0';
            }else{
                $coupon->status = $data['status'];
            }
            
            $coupon->save();
            return redirect('admin/view-coupons')->with('flash_message_success','Coupon Berhasil Ditambah');
            
        }

        return view('admin.coupons.add_coupon');
    }

    public function viewCoupons(){
        $coupons = Coupon::get();
        return view('admin.coupons.view_coupons')->with(compact('coupons'));
    }

    public function editCoupon(Request $request,$id=null){
        $couponDetails = Coupon::find($id);

        if($request->isMethod('post')){
            $data = $request->all();
            $coupon = Coupon::find($id);
            $coupon->coupon_code = $data['coupon_code'];
            $coupon->amount = $data['amount'];
            $coupon->amount_type = $data['amount_type'];
            $coupon->expiry_date = $data['expiry_date'];
            if (empty($data['status'])) {
                $coupon->status = '0';
            }else{
                $coupon->status = $data['status'];
            }
            $coupon->save();
            return redirect('admin/view-coupons')->with('flash_message_success','Coupon Berhasil Diubah');
            
        }

        return view('admin.coupons.edit_coupon')->with(compact('couponDetails'));
    }

    public function deleteCoupon($id= null){
        Coupon::where(['id'=>$id])->delete();
        return redirect()->back()->with('flash_message_success','Coupons Deleted Successfully');
    }

}
