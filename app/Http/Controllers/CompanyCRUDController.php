<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Company;

class CompanyCRUDController extends Controller
{
    public function index(){
        $data['companies'] = Company::orderBy('id','desc')->paginate(5);
        return view('index',$data);
    }
    public function create(){
        error_log('Some message here.');
        return view('create');
    }
    public function store(Request $request){
        $request-> validate([
            'name'=>'required',
            'email'=>'required',
            'address'=>'required'
        ]);
        $company = new Company();
        $company->name = $request->name;
        $company->email= $request->email;
        $company->address = $request->address;
        $company->save();
        return redirect()->route('companies.index')->with('success','Company has been created Successfully');
    }
    public function show(Company $company){
        return view('show',compact('company'));
    }
    public function edit(Company $company){
        return view('edit',compact('company'));
    }
    public function update(Request $request,$id){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'address'=>'required'
        ]) ;
        $company=Company::find($id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->save();
        return redirect()->route('companies.index')->with('success','Company has been updated Successfully');
    }
    public function destroy(Company $company){
        $company->delete();
        return redirect()->route('companies.index')->with('success','Company has been Deleted successfully');
    }
}
