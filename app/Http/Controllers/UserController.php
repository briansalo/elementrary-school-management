<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function UserView(){
        $data['alldata'] = User::where('usertype','Admin')->get();
        return view('backend.user.view_user',$data); 
    }

    public function UserAdd(){
        return view('backend.user.add_user');

    }

    public function UserStore(Request $request){

        $validatedData = $request->validate([
            'email' => 'required|unique:users',
            'user_name' => 'required',
        ]);

        $data = new User();
        $code = rand(0000,9999); //create random password
        $data->usertype = 'Admin';
        $data->role = $request->role;
        $data->name = $request->user_name;
        $data->email = $request->email;
        $data->password = bcrypt($code);
        $data->code = $code;
        $data->save();

        $notification = array(
            'message' => 'User Inserted Successfully',
            'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('user.view')->with($notification);
    }

    public function UserEdit($id){
        $editData = User::find($id);
        return view('backend.user.edit_user', compact('editData'));
    }


    public function UserUpdate(Request $request, $id){
        $data = User::Find($id);
        $data->name = $request->user_name;
        $data->email = $request->email;
         $data->role = $request->role;
        $data->save();

        $notification = array(
            'message' => 'User Updated Successfully',
            'alert-type' => 'info'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('user.view')->with($notification);

    }

    public function UserDelete($id){
        $user = User::find($id);
        $user->delete();

        $notification = array(
            'message' => 'User Deleted Successfully',
            'alert-type' => 'info'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('user.view')->with($notification);
    }








}
