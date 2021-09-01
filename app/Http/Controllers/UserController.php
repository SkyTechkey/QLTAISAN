<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Role;
use App\Models\User;
use App\Models\Branch;
use App\Models\RoleUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
   
    public function index(Request $request)
    {
       
            $users = User::all();
            $departments = Department::all();
            $branches = Branch::all();
            $roles = Role::all();
            return view('users.index', compact('users', 'branches','departments','roles'));
    }

    public function create(Request $request)
    {
        return 'view create';
    }

    public function store(Request $request)
    {
      

        $validation = Validator::make($request->all(),
        [
            'name' => 'required|max:255',
            'username' => 'required|max:50|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password'=>'required|min:5',
        ],[
            'name.required' => "Tên đang để trống",
            'email.required' => "Email đang để trống",
            'email.unique' => "Email bị trùng",
            'username.required' => "username đang để trống",
            'username.unique' => "username bị trùng",
            'password.required' => "Hãy nhập mật khẩu",
            'password.min'=>"Nhập mật khẩu vào cho đủ 5 kí tự",            
        ]);

        if ($validation->fails()){
            $response=array('status'=>'error','errors'=>$validation->errors()->toArray()); 
            return back()->with('fail','Something went wrong, try again!');
        }


        $user = new User;
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->status = true;
        $user->department_id = $request->department_id;
        $user->password = Hash::make($request->password);
        $save = $user->save();

        foreach($request->role_id as $role_id){
            RoleUser::create(
                ['role_id' => $role_id, 'user_id' => $user->id],
            );
        }
        if($save){
            return back()->with('success','New User has been successfuly added to database');
        }else{
            return back()->with('fail','Something went wrong, try again!');
        }
    }

    public function show(Request $request, $id)
    {
        $user = User::find($id);
        return $user;
    }

    public function edit(Request $request, $id)
    {
       return 'view edit';
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'username' => 'required|max:50',
            'email' => 'required|email|max:255',
        ]);
        if($request->password){
            $request->validate([
                'password'=>'required|min:5'
            ]);
        }
        $user = User::find($id);
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->status = true;
        $user->department_id = $request->department_id;
        if($request->password){
            $user->password = Hash::make($request->password);
        }
        $save = $user->save();
       
        RoleUser::where('user_id',$id)->delete();
      
        foreach($request->role_id as $role_id){
            RoleUser::create(
                ['role_id' => $role_id, 'user_id' => $user->id],
            );
        }
      
        if($save){
            return back()->with('success', 'Hành động thực hiện thành công');
        }else{
            return back()->with('fail','Something went wrong, try again!');
        }
    }

    // Function lock/unlock user
    public function destroy($id, Request $request)
    {
        $user = User::find($id);
        $user->status = $user->status ? 0 : 1;
        $save = $user->save();

        if($save) {
            // message success
            return back();
        }
        else {
            // message fail
            return back();
        }
    }

    public function getUsers($branch_id) {
        $users = [];
        if($branch_id == 0) {
            $users = User::all();
            foreach($users as $user) {
                $user->department_name = Department::where('id', $user->department_id)->firstOrFail()->name;
            }
        }
        else {
            $departs = Department::where('branch_id', $branch_id)->get();
            foreach($departs as $depart) {
                $usersTerm = User::where('department_id', $depart->id)->get();
                foreach($usersTerm as $userTerm) {
                    $userTerm->department_name = $depart->name;
                    $users[count($users)] = $userTerm;
                }
            }
        }
        
        return $users;
    }
}
