<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Models\users\User;
use App\Models\role\Role;

use Illuminate\Http\Request;
use Session;

class UsersControllers extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    // Index View and Scope Data
    public function index()
    {
        return view('users.index', [
            "title" => "List User",
            "users" => User::all()->where('deleted_at',null),
            "roles" => Role::all()->where('deleted_at',null)
        ]);
    }

    // Create View Data
    public function create()
    {
        $data['title'] = "Add User";
        $data['url'] = 'store';
        $data['disabled_'] = '';
        $data['roles'] = Role::all();
        return view('users.create', $data);
    }

    // Store Function to Database
    public function store(Request $request)
    {
        $datenow = date('Y-m-d H:i:s');
        $exec = User::where('email', $request->email)->first();
        $exec_2 = User::where('username', $request->username)->first();
        $exec_3 = User::where('phone', $request->phone)->first();
        $exec_4 = User::where('npwp', $request->phone)->first();

        if($exec || $exec_2 || $exec_3 || $exec_4){
            return back()->with(['gagal' => 'Data Already Exist!']);
        }else{

            $store = User::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'email' => $request->email,
                'address' => $request->address,
                'city' => $request->city,
                'province' => $request->province,
                'zipcode' => $request->zipcode,
                'npwp' => $request->npwp,
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'role_id' => $request->role,
                'total_discount' => $request->total_discount,
                'credit_limit' => $request->credit_limit,
                'created_at' => $datenow
            ]);

            if($store){
                return redirect()->route('admin.users.index')->with(['success' => 'Data successfully stored!']);
            }else{
                return back()->with(['gagal' => 'Failed!']);
            }

        }
    }

    // Detail Data View by id
    public function detail($id)
    {
        $data['title'] = "Detail User";
        $data['disabled_'] = 'disabled';
        $data['url'] = 'create';
        $data['users'] = User::where('id', $id)->first();
        $data['roles'] = Role::all();
        return view('users.create', $data);
    }

    // Edit Data View by id
    public function edit($id)
    {
        $data['title'] = "Edit User";
        $data['disabled_'] = '';
        $data['url'] = 'update';
        $data['users'] = User::where('id', $id)->first();
        $data['roles'] = Role::all();
        return view('users.create', $data);
    }

    // Update Function to Database
    public function update(Request $request)
    {
        date_default_timezone_set("Asia/Bangkok");
        $datenow = date('Y-m-d H:i:s');

        if($request->password){

            if($request->role == 2){
                $update = User::where('id', $request->id)->update([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'address' => $request->address,
                    'city' => $request->city,
                    'province' => $request->province,
                    'zipcode' => $request->zipcode,
                    'npwp' => $request->npwp,
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                    'total_discount' => $request->total_discount,
                    'credit_limit' => $request->credit_limit,
                    'updated_at' => $datenow
                ]);
            }else{
                $update = User::where('id', $request->id)->update([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'username' => $request->username,
                    'password' => bcrypt($request->password),
                    'updated_at' => $datenow
                ]);
            }

            if($update){
                return redirect()->route('admin.users.index')->with(['success' => 'Data successfully updated!']);
            }else{
                return back()->with(['gagal' => 'Failed!']);
            }

        }else{

            if($request->role == 2){
                $update = User::where('id', $request->id)->update([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'address' => $request->address,
                    'city' => $request->city,
                    'province' => $request->province,
                    'zipcode' => $request->zipcode,
                    'npwp' => $request->npwp,
                    'username' => $request->username,
                    'total_discount' => $request->total_discount,
                    'credit_limit' => $request->credit_limit,
                    'updated_at' => $datenow
                ]);
            }else{
                $update = User::where('id', $request->id)->update([
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'email' => $request->email,
                    'username' => $request->username,
                    'updated_at' => $datenow
                ]);
            }

            if($update){
                return redirect()->route('admin.users.index')->with(['success' => 'Data successfully updated!']);
            }else{
                return back()->with(['gagal' => 'Failed!']);
            }
        }
    }

    // Delete Data Function
    public function delete(Request $req)
    {
        date_default_timezone_set("Asia/Bangkok");
        $datenow = date('Y-m-d H:i:s');
        $exec = User::where('id', $req->id )->update([
            'updated_at'=> $datenow,
            'deleted_at'=> $datenow
        ]);

        if ($exec) {
            Session::flash('success', 'Data successfully deleted!');
          } else {
            Session::flash('gagal', 'Error Data');
          }
    }


}
