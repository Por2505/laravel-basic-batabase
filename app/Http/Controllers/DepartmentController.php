<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
{
    public function index(){
        return view('admin.department.index');
    }
    public function store(Request $request){
        // dd($request->department_name);
        $request->validate(
            [
                'department_name'=>'required|unique:departments|max:255'
            ],
            [
                'department_name.required'=>"กรุณาป้อนชื่อแผนก",
                'department_name.max'=>"ห้ามป้อนเกิน 255 ตัว",
                'department_name.unique'=>"มีข้อมูลชื่อแผนกนี้ในฐานข้อมูลแล้ว"
            ]
        );
        $department = new Department;
        $department->department_name = $request->department_name;
        $department->user_id = Auth::user()->id;
        $department->save();
        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อยแล้ว");


    }
}
