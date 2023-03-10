<?php

namespace App\Http\Controllers;
use App\Models\Admin; // bring Model of admin
use Illuminate\Http\Request; // to use request method
use Illuminate\Support\Facades\Hash; // use to use the hash function


// we are using this controller for login and logout
class AdminController extends Controller
{

    //  user logedin or not
    public function index(Request $request)
    {
        // If user has loged in then redirect to admin.dashboard
        if($request->session()->has('ADMIN_LOGIN'))
        {
            $user = AdminAuth::user();
            echo $user->name;
            return redirect('admin/dashboard');

        }
        // if not logedin then redirect to the login page
        else{
            return view('admin/login');
        }
        return view('admin/login');
    }


    // when user fill login  form then redirect to dashboard
    // public function dashboard()
    // {
    //     return view('admin/dashboard');
    // }

    // check the user credntials with database
    public function auth(Request $request)
    {
        $email = $request->post('email');
        $password = $request->post('password');
        // $password = Hash::make($request->post('password'));
        // $result = Admin::where(['email' => $email, 'password' => $password])->get();
        $result = Admin::where(['email' => $email])->first();
        if($result)
        {
            if(Hash::check($request->post('password'), $result->password))
            {
                $request->session()->put('ADMIN_LOGIN', true);
            $request->session()->put('ADMIN_ID', $result->id);
            return redirect('admin/dashboard');
            }
            else{
                $request->session()->flash('error', 'plz enter correct password');
            return redirect('/');

            }

        }
        else{
            $request->session()->flash('error', 'plz enter valid info');
            return redirect('/');

        }

    }

    // update password
    // public function updatepassword()
    // {
    //     $r = Admin::find(1);
    //     $r->password = Hash::make('admin');
    //     $r->save();

    // }
}
