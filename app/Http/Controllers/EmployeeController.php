<?php

namespace App\Http\Controllers;

use App\Exports\EmployeeExport;
use App\Imports\EmployeeImport;
use App\Imports\EmpoloyeeImport;
use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use PDF;
use Excel;
use Illuminate\Support\Facades\Redirect;
// use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Fluent;

class EmployeeController extends Controller
{
    public function index(Request $request){
        if($request->has('search')){
            $data = Employee::where('name','LIKE','%'. $request->search .'%')
            ->orWhere('gender','LIKE','%'. $request->search .'%')
            ->orWhere('phone','LIKE','%'. $request->search .'%')->paginate(7);
            // var_dump($request->search);
            // exit;

            // Its to instaul in site
            Session::put('halaman_url', request()->fullUrl());
        }else{
            $data = Employee::all();
            $data = Employee::orderby('id', 'desc')->paginate(15);

            // Its to instaul in site
            Session::put('halaman_url', request()->fullUrl());
        }
        // dd($data);
        // return view('datapage',$data);
        return view('employees.datapage',compact('data'));
    }

    public function plusdata(){
        return view('employees.plusdata');
    }

    public function insertdata(Request $request){
        // dd($request->all());

        $this->validate($request,[
            'name' => 'required|min:3|max:25',
            'phone' => 'required|min:7|max:20',
            'foto' => 'required',
        ]);

        $data = Employee::create($request->all());
        if($request->hasFile('foto')){
            $request->file('foto')->move('fotodatapage/',$request->file('foto')->getClientOriginalName());
            $data->foto =$request->file('foto')->getClientOriginalName();
            $data->save();
        }
        return redirect()->route('datapage')->with('success','Data has been registered successfully');
    }

    public function editdata($id){
        $data = Employee::find($id);
        // dd($data);
        return view('employees.editdata', compact('data'));
    }

    public function update(Request $request, $id){

        $this->validate($request,[
            'name' => 'required|min:3|max:25',
            'phone' => 'required|min:7|max:20',
            // 'foto' => 'required',
        ]);

        $data = Employee::find($id);
        $data->name = $request->name;
        $data->phone = $request->phone;
        $data->gender = $request->gender;

        if($request->hasFile('foto')){
            $request->file('foto')->move('fotodatapage/',$request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            // $data->update($request->all());
            // var_dump($data->name);
            // exit;
        }
        $data->update();
        // var_dump($data->name);
        // exit;

            // Its to instaul in site
        if(Session::get('halaman_url')){
            return Redirect(session('halaman_url'))->with('success','Data has been Update successfully');
        }

        return redirect()->route('datapage')->with('success','Data has been Update successfully');
    }

    public function deleteemp($id){
        $data = Employee::find($id);
        $data->delete();
        return redirect()->route('employees.datapage')->with('delete','Data has been registered Delete');
    }

    public function exportpdf(){
        $data = Employee::all();

        view()->share('data',$data);
        $pdf = PDF::loadview('dataemp-pdf');
        return $pdf->download('data.pdf');
        // return view('dataemp-pdf',compact('data'));
    }

    public function exportexcel(){
        return Excel::download(new EmployeeExport, 'dataemployees.xlsx');
    }

    public function importexcel(Request $request){
        $data = $request->file('file');

        $namefile = $data->getClientOriginalName();
        $data->move('EmployeeData', $namefile);

        Excel::import(new EmployeeImport, \public_path('/EmployeeData/'.$namefile));
        return redirect()->back()->with('success', 'Data has been Insert SuccessFully');
        // ->with('success','Data has been Update successfully');
    }


}
