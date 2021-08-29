<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use App\Imports\ProductsImport;
use App\Models\Products;
use Illuminate\Http\Request;
// use Barryvdh\DomPDF\PDF;
use PDF;
use Excel;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;

class ProductsController extends Controller
{
    public function index(Request $request){
        if($request->has('search')){
            $productsdata = Products::where('name','LIKE','%'. $request->search .'%')->paginate(5);
        }else{
            $productsdata = Products::all();
            $productsdata = Products::orderby('id', 'desc')->paginate(5);
        }
        // $productsdata = Products::all();
        // var_dump($productsdata->count('id');
        // exit;
        return view('products.productsdata',compact('productsdata'));
    }

    public function plusproduct(){
        return view('products.plusproduct');
    }

    public function inserproduct(Request $request){
        $productsdata = Products::create($request->all());
        if($productsdata->price){
            $t = 1.5;
            $t2 = $productsdata->price;
            $t3 = $t + $t2;
            $productsdata->tax = $t3 ;
            // var_dump($t2);
            // var_dump($t3);
            // var_dump($productsdata->price);
            // exit;
        }
        if($request->hasFile('foto')){
            $request->file('foto')->move('fotoproducts/',$request->file('foto')->getClientOriginalName());
            $productsdata->foto =$request->file('foto')->getClientOriginalName();
            $productsdata->save();
        }
        return redirect()->route('productsdata')->with('success','Data has been insert product successfully');
    }

    public function editproduct(Request $request, $id){
        $productsdata = Products::find($id);
        return view('products.editproduct',compact('productsdata'));
    }

    public function addproduct(Request $request, $id){
        $productsdata = Products::find($id);
        return view('products.addproduct',compact('productsdata'));
    }

    public function updateproduct(Request $request, $id){
        $productsdata = Products::find($id);
        $productsdata->name = $request->input('name');

        if($request->hasFile('foto')){
            $request->file('foto')->move('fotoproducts/',$request->file('foto')->getClientOriginalName());
            $productsdata->foto = $request->file('foto')->getClientOriginalName();
            $productsdata->save($request->all());
            // $productsdata->update();
        }
        // var_dump($productsdata->foto);
        // exit;
        // $productsdata->update($request->all());
        return redirect()->route('productsdata')->with('success','Data has been Update product successfully');
    }

    public function uaddproduct(Request $request, $id){
        $addproducts = Products::find($id);
        // $add = Products::find($id);
        $addproducts->quantity = $request->input('quantity');

        $addproducts->update($request->all());
        return redirect()->route('productsdata')->with('success','Data has been Add quantity product successfully');
    }

    public function delete($id){
        $data = Products::find($id);
        $data->delete();
        return redirect()->route('productsdata')->with('delete','Data has been  Delete Product');
    }

    public function exportpdf_product(){
        $pdfproduct = Products::all();
        view()->share('pdfproduct',$pdfproduct);
        $pdf = PDF::loadview('products.datapoduct-pdf');
        return $pdf->download('pdfproduct.pdf');
    }

    public function exportexcel_products(){
        return Excel::download(new ProductsExport, 'dataproducts.xlsx');
    }


    public function importexcel_products(Request $request){
        $data = $request->file('file');

        $namefile = $data->getClientOriginalName();
        $data->move('DataProducts', $namefile);

        Excel::import(new ProductsImport, \public_path('/DataProducts/'.$namefile));
        return redirect()->back()->with('success', 'Data has been Insert SuccessFully');
    }
}
