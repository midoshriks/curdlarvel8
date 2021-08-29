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
class EmployeeController extends Controller
{
    public function index(Request $request){
        if($request->has('search')){
            $data = Employee::where('name','LIKE','%'. $request->search .'%')->paginate(7);
        }else{
            $data = Employee::all();
            $data = Employee::orderby('id', 'desc')->paginate(7);
        }
        // dd($data);
        // return view('datapage',$data);
        return view('datapage',compact('data'));
    }

    public function plusdata(){
        return view('plusdata');
    }

    public function insertdata(Request $request){
        // dd($request->all());
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
        return view('editdata', compact('data'));
    }

    public function update(Request $request, $id){
        $data = Employee::find($id);

        if($request->hasFile('foto')){
            $request->file('foto')->move('fotodatapage/',$request->file('foto')->getClientOriginalName());
            $data->foto = $request->file('foto')->getClientOriginalName();
            // $data->update($request->all());
            $data->update();
            // var_dump($data->name);
            // exit;
        }

        
        return redirect()->route('datapage')->with('success','Data has been Update successfully');
    }

    public function deleteemp($id){
        $data = Employee::find($id);
        $data->delete();
        return redirect()->route('datapage')->with('delete','Data has been registered Delete');
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
