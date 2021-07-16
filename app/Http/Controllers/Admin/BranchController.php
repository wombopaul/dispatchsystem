<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;

class BranchController extends Controller
{
    
    public function index()
    {
        $pageTitle = "Manage Branch";
        $emptyMessage = "No data found";
        $branchs = Branch::latest()->paginate(getPaginate());
        return view('admin.branch.index', compact('pageTitle', 'emptyMessage', 'branchs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:40|unique:branches',
            'email' => 'required|email|max:40|unique:branches',
            'phone' => 'required|max:40|unique:branches',
            'address' => 'required|max:255',
        ]);
        $barnch = new Branch();
        $barnch->name = $request->name;
        $barnch->email = $request->email;
        $barnch->phone = $request->phone;
        $barnch->address = $request->address;
        $barnch->status = $request->status ? 1: 0;
        $barnch->save();
        $notify[] = ['success', 'Branch has been created'];
        return back()->withNotify($notify);
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|max:40|unique:branches,name,'.$request->id,
            'email' => 'required|email|max:40|unique:branches,email,'.$request->id,
            'phone' => 'required|max:40|unique:branches,phone,'.$request->id,
            'address' => 'required|max:255',
        ]);
        $barnch = Branch::findOrFail($request->id);
        $barnch->name = $request->name;
        $barnch->email = $request->email;
        $barnch->phone = $request->phone;
        $barnch->address = $request->address;
        $barnch->status = $request->status ? 1: 0;
        $barnch->save();
        $notify[] = ['success', 'Branch has been updated'];
        return back()->withNotify($notify);
    }
}
