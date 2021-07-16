<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Branch;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class BranchManagerController extends Controller
{
    
    public function index()
    {
        $pageTitle = "All Branch Manager";
        $emptyMessage = "No data found";
        $branchManagers = User::where('user_type', 'manager')->latest()->with('branch')->paginate(getPaginate());
        return view('admin.manager.index', compact('pageTitle', 'emptyMessage', 'branchManagers'));
    }

    public function create()
    {
        $pageTitle = "Add New Branch Manager";
        $branchs = Branch::select('name', 'id')->where('status', 1)->latest()->get();
        return view('admin.manager.create', compact('pageTitle', 'branchs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'branch' => 'required|exists:branches,id',
            'fname' => 'required|max:40',
            'lname' => 'required|max:40',
            'email' => 'required|email|max:40|unique:users',
            'username' => 'required|max:40|unique:users',
            'mobile' => 'required|max:40|unique:users',
            'password' =>'required|confirmed|min:4',
        ]);
        $manager = new User();
        $manager->branch_id = $request->branch;
        $manager->firstname = $request->fname;
        $manager->lastname = $request->lname;
        $manager->username = trim($request->username);
        $manager->email = trim($request->email);
        $manager->mobile = $request->mobile;
        $manager->user_type = "manager";
        $manager->status = $request->status ? 1 : 0;
        $manager->password  = Hash::make($request->password);
        $manager->save();
        $notify[] = ['success', 'Manager has been created'];
        notify($manager, 'MANAGER_CREATE', [
            'username' => $manager->username,
            'email' => $manager->email,
            'password' => $request->password,
        ]);
        return back()->withNotify($notify);
    }

    public function edit($id)
    {
        $pageTitle = "Update Branch Manager";
        $branchs = Branch::select('name', 'id')->where('status', 1)->latest()->get();
        $manager = User::findOrFail($id);
        return view('admin.manager.edit', compact('pageTitle', 'branchs', 'manager'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'branch' => 'required|exists:branches,id',
            'fname' => 'required|max:40',
            'lname' => 'required|max:40',
            'email' => 'required|email|max:40|unique:users,email,'.$id,
            'username' => 'required|max:40|unique:users,username,'.$id,
            'mobile' => 'required|max:40|unique:users,mobile,'.$id,
            'password' =>'nullable|confirmed|min:4',
        ]);
        $manager =User::findOrFail($id);
        $manager->branch_id = $request->branch;
        $manager->firstname = $request->fname;
        $manager->lastname = $request->lname;
        $manager->username = $request->username;
        $manager->email = $request->email;
        $manager->mobile = $request->mobile;
        $manager->status = $request->status ? 1 : 0;
        $manager->user_type = "manager";
        $manager->password  = $request->password ? Hash::make($request->password) : $manager->password;
        $manager->save();
        $notify[] = ['success', 'Manager has been updated'];
        return back()->withNotify($notify);
    }

    public function staffList($branchId)
    {
        $pageTitle = "Staff List";
        $emptyMessage = "No data found";
        $staffs = User::where('user_type', 'staff')->where('branch_id', $branchId)->with('branch')->paginate(getPaginate());
        return view('admin.manager.staff', compact('pageTitle', 'emptyMessage', 'staffs'));
    }

}
