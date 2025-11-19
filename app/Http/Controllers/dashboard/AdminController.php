<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    public function showLogin(){
        return view('dashboard.loginAdmin');
    }
    public function login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|max:8'
        ]);
        $user=User::where('email',$request->email)->first();
        if(!$user){
            return back()->with('fail','Email not found');
        }
        if(!Hash::check($request->password,$user->password)){
            return back()->with('fail','Password is incorrct');
        }
        if($user->role !=="admin"){
            return back()->with('fail','Unathurized person');
        }
        Auth::login($user);
        return redirect()->route('dashboard')->with('success','Admin Login Successfully');
    }

    public function dashboard(){
        $data=User::first();
        return view('dashboard.index',[
            'data'=>$data
        ]);
    }
    public function form1(){
        return view('dashboard.formSinup');
    }
    public function table(){
        return view('dashboard.dataTable');
    }
    public function profile(){
        $data=User::first();
        return view('dashboard.updateProfile',[
            'data'=>$data
        ]);
    }
    public function updateProfile(Request $request){
        $data=User::first();
        $data->name=$request->name;
        $data->email=$request->email;
        if($request->password){
            $data->password=Hash::make($request->password);
        }
        if($request->hasFile('image')){
            if($data->image){
                $path=public_path($data->image);
                if($path){
                    unlink($path);
                }
            }
            $image=$request->file('image');
            $imageName=uniqid().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads'),$imageName);
            $data->image='uploads/'.$imageName;
        }
        $data->save();
        return redirect()->route('update.profile')->with('success','Data Updated Successfuly');
    }
    public function logout( Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('showLogin')->with('success', 'You have been logged out successfully.');
    }
}
