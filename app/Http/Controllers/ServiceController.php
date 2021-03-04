<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use Carbon\Carbon;

class ServiceController extends Controller
{
    public function index(){
  
        $services = Service::paginate(3);
 
        return view('admin.service.index',compact('services'));
    }
    public function store(Request $request){
        $request->validate(
            [
                'service_name'=>'required|unique:services|max:255',
                'service_image'=>'required|mimes:jpg,jpeg,png'
            ],
            [
                'service_name.required'=>"กรุณาป้อนชื่อบริการ",
                'service_name.max'=>"ห้ามป้อนเกิน 255 ตัว",
                'service_name.unique'=>"มีข้อมูลชื่อแผนกนี้ในฐานข้อมูลแล้ว",
                'service_image.required' =>"อัปโหลดภาพ"
            ]
        );
        
        //เข้ารหัสรูปภาพ
        $service_image=$request->file('service_image');
        $image_gen=hexdec(uniqid());
        $img_ext= strtolower($service_image->getClientOriginalExtension());
        $img_name=$image_gen.".".$img_ext;
        //upload
        $upload_location= 'image/services/';
        $full_path=$upload_location.$img_name;
        Service::insert([
            'service_name'=>$request->service_name,
            'service_image'=>$full_path,
            'created_at'=>Carbon::now()
        ]);
        $service_image->move($upload_location,$img_name);
        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อยแล้ว");

    }
    public function edit($id){
        $service= Service::find($id);
        return view('admin.service.edit',compact('service'));
     }

     public function update(Request $request , $id){
        $request->validate(
            [
                'service_name'=>'max:255',
                'service_image'=>'mimes:jpg,jpeg,png'
            ],
            [
                'service_name.max'=>"ห้ามป้อนเกิน 255 ตัว"

            ]
        );
        
        $service_image=$request->file('service_image');
        if($service_image){
            dd("อับภาพ");
        }
        else{
            dd("อัปชื่ออย่างเดียว");
        }
        // Service::find($id)->update(['service_name'=>$request->service_name,
        // 'user_id'=>Auth::user()->id
        // ]);
        //return redirect()->route('service')->with('success','อัปเดตข้อมูลสำเร็จ');
    }
    

    
}
