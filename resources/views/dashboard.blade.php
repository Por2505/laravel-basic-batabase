<x-app-layout>
    <x-slot name="header">
        <div class="font-semibold text-xl text-gray-800 leading-tight">
            <p>Hello ,{{Auth::user()->name}}</p>
            
            <p class="float-right">จำนวนผู้ใช้ระบบ {{count($users)}} คน</p>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
            <table class="table">
  <thead>
    <tr>
      <th scope="col">ลำดับ</th>
      <th scope="col">ชื่อ</th>
      <th scope="col">email</th>
      <th scope="col">เริ่มใช้งานระบบ</th>
    </tr>
  </thead>
  <tbody>
    @php($i=1)
    @foreach($users as $row)
    <tr>
      <th scope="row">{{$i++}}</th>
      <td>{{$row->name}}</td>
      <td>{{$row->email}}</td>
      <td>{{Carbon\Carbon::parse($row->created_at)->diffForHumans()}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
            </div>
        </div>
    </div>
</x-app-layout>
