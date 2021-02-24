<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index(){
        //eloquent
       // $departments = Department::all();
       //query builder
        //$departments=DB::table('departments')->get();
        //$departments = Department::paginate(3);
        $departments = DB::table('departments')->paginate(5);
        return view('admin.department.index',compact('departments'));
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
        //eloquent
        // $department = new Department;
        // $department->department_name = $request->department_name;
        // $department->user_id = Auth::user()->id;
        // $department->save();

        //query builder
        $data = array();
        $data["department_name"]= $request->department_name;
        $data["user_id"]= Auth::user()->id;
        DB::table('departments')->insert($data);
        return redirect()->back()->with('success',"บันทึกข้อมูลเรียบร้อยแล้ว");

    }
}
