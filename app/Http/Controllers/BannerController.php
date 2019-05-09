<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Banner;
use Illuminate\Support\Facades\Input;
use Image;

class BannerController extends Controller
{

    public function viewBanners(){
        $banners = Banner::get();
        return view('admin.banners.view_banners')->with(compact('banners'));
    }

    public function deleteBanner($id=null){
        Banner::where('id',$id)->delete();
        return redirect()->back()->with('flash_message_success','Banner Berhasil Dihapus');
    }

    public function editBanner(Request $request,$id=null){

        if($request->isMethod('post')){
            $data = $request->all();

            if ($request->hasFile('image')) {
                $img_tmp = Input::file('image');
                if ($img_tmp->isValid()) {
                    $extension = $img_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $banner_path = 'images/frontend_images/'.$filename;
                    //Resize
                    Image::make($img_tmp)->resize(1200,675)->save($banner_path);
                    //store image in banner folder
                    $data['image']->image = $filename;

                }
            
            }elseif (!empty($data['current_image'])) {
                $filename = $data['current_image'];
            }else{
                $filename = '';
            }
            if(empty($data['status'])){
                $status = 0;
            }else{
                $status = 1;
            }

            Banner::where('id',$id)->update(['status'=>$status,'title'=>$data['title'],'link'=>$data['link'],'image'=>$filename]);
            return redirect()->back()->with('flash_message_success','Banner Berhasil Diubah');

        }

        $bannerDetails = Banner::where('id',$id)->first();
        return view('admin.banners.edit_banner')->with(compact('bannerDetails'));
    }

    public function addBanner(Request $request){

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data);die;
            
            $banner = new Banner;
            $banner->title = $data['title'];
            $banner->link = $data['link'];

            if ($request->hasFile('image')) {
                $img_tmp = Input::file('image');
                if ($img_tmp->isValid()) {
                    $extension = $img_tmp->getClientOriginalExtension();
                    $filename = rand(111,99999).'.'.$extension;
                    $banner_path = 'images/frontend_images/'.$filename;
                    //Resize
                    Image::make($img_tmp)->resize(1200,675)->save($banner_path);
                    //store image in banner folder
                    $banner->image = $filename;

                }
            }

            if(empty($data['status'])){
                $status = 0;
            }else{
                $status = 1;
            }

            $banner->status = $status;
            $banner->save();

            return redirect()->back()->with('flash_message_success','Banner Berhasil ditambah');

        }
        return view('admin.banners.add_banner');
    }
}
