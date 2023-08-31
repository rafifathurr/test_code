<?php

namespace App\Http\Controllers\forgot;

use App\Http\Controllers\Controller;
use App\Models\users\User;

use Illuminate\Http\Request;

class ForgotControllers extends Controller
{

    // Index View and Scope Data
    public function index()
    {
        return view('auth.forgot');
    }

    // Store Function to Database
    public function updatepass(Request $req)
    {
        date_default_timezone_set("Asia/Bangkok");
        $datenow = date('Y-m-d H:i:s');

        $exec = count(User::where('email', $req->email)->get());

        if($exec == 1){
            if($req->password == $req->repassword){
                $email_update = User::where('email', $req->email)->update([
                    'password' => bcrypt($req->password),
                    'updated_at' => $datenow
                ]);

                return redirect()->route('login.index')->with(['success' => 'Success Change Password!']);
            }else{
                return redirect()->route('forgot.index')->with(['gagal' => 'Unmatch Password!']);
            }
        }else{
            return redirect()->route('forgot.index')->with(['gagal' => 'Email Not Exist!']);
        }
    }
}
