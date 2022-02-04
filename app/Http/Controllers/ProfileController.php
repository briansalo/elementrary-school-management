<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function ProfileView(){
        $id = Auth::user()->id;
        $user = User::find($id);

        return view('backend.user.view_profile',compact('user'));

    }

    public function ProfileEdit(){
        $id = Auth::user()->id;
        $editData = User::find($id);          

        return view('backend.user.edit_profile',compact('editData'));
    }

    public function ProfileUpdate(Request $request){

        $id = Auth::user()->id;
        $editData = User::find($id); 
        $editData->name = $request->user_name;
        $editData->email = $request->email;
        $editData->address = $request->address;
        $editData->gender = $request->gender;
        $editData->mobile_number = $request->mobile_number;
        
        if($request->file('image')){  // if there's an image
            $file= $request->file('image'); // store the image in the variable
            @unlink(public_path('upload/user_images/'.$editData->profile_photo_path)); //to delete the previous image
            $filename = date('YmdHi').$file->getClientOriginalName(); // make own name of the images
            $file->move(public_path('upload/user_images'),$filename); //location of the storage
            $editData->profile_photo_path = $filename;
        }
        $editData->save(); 

        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'  //success variable came from admin.blade.php in java script toastr
        );
        return redirect()->route('user.view')->with($notification);

    }

    public function ChangePassword(){
        return view('backend.user.change_password');
    }

    public function PasswordUpdate(Request $request){

        $validatedData = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed',
            'password_confirmation' => 'required',

        ]);

        $hashedPassword = Auth::user()->password;
        if(Hash::check($request->current_password, $hashedPassword)){ //check if the old password is same to the input password
            $user= User::find(Auth::id());
            $user->password = Hash::make($request->password); // the new input password convert to hash
            $user->save();
            Auth::logout();
            return redirect()->route('login');
        }else
        $notification = array(
            'message' => 'The current password did not match from our record',
            'alert-type' => 'error'  //success variable came from admin.blade.php in java script toastr
        );        
            return redirect()->back()->with($notification);

    }

















}
