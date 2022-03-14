<?php

namespace App\Http\Controllers;

use App\Rules\MatchOldPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile(){
        return view("user-profile.profile");
    }

    public function editPhoto(){
        return view('user-profile.edit-photo');
    }

    public function editPassword(){
        return view('user-profile.edit-password');
    }

    public function editInfo(){
        return view('user-profile.edit-info');
    }

    public function changePassword(Request $request){

        $request->validate([
            'current_password' => ['required', new MatchOldPassword()],
            'new_password' => ['required','min:8'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        Auth::logout();
        return redirect()->route('login')->with("toast",["icon"=>"success","title"=>"Password Changed Successfully."]);

    }

    public function changeName(Request $request){
        $request->validate([
            'name' => "required|min:3|max:50",
        ]);
        $user = User::find(Auth::id());
        $user->name = $request->name;
        $user->update();
        return redirect()->back()->with("toast",["icon"=>"success","title"=>"Information Updated Successfully."]);

    }

    public function changeEmail(Request $request){
        $request->validate([
            'email' => "required|min:3|max:50",
        ]);
        $user = User::find(Auth::id());
        $user->email = $request->email;
        $user->update();
        return redirect()->back()->with("toast",["icon"=>"success","title"=>"Information Updated Successfully."]);

    }

    public function changePhone(Request $request){
        $request->validate([
            "phone" => "required|max:15"
        ]);
        $user = User::find(Auth::id());
        $user->phone = $request->phone;
        $user->update();
        return redirect()->back()->with("toast",["icon"=>"success","title"=>"Information Updated Successfully."]);
    }

    public function changeAddress(Request $request){
        $request->validate([
            "address" => "required|max:300"
        ]);
        $user = User::find(Auth::id());
        $user->address = $request->address;
        $user->update();
        return redirect()->back()->with("toast",["icon"=>"success","title"=>"Information Updated Successfully."]);
    }

    public function changePhoto(Request $request){
        $request->validate([
            "photo" => "required|mimetypes:image/jpeg,image/png|dimensions:ratio=1/1|file|max:2500"
        ]);
        $dir="public/profile/";

        Storage::delete($dir.Auth::user()->photo);

        $newName = uniqid()."_photo.".$request->file("photo")->getClientOriginalExtension();
        $request->file("photo")->storeAs($dir,$newName);

        $user = User::find(Auth::id());
        $user->photo = $newName;
        $user->update();

        return redirect()->route("profile.edit.photo")->with("toast",["icon"=>"success","title"=>"Photo Updated Successfully."]);

    }

    public function updateInfo(Request $request){
        $request->validate([
            "phone" => "required|max:15",
            "address" => "required|max:300",
        ]);

        $currentUser = User::find(Auth::id());
        $currentUser->phone = $request->phone;
        $currentUser->address = $request->address;
        $currentUser->save();
        return redirect()->back()->with("toast",["icon"=>"success","title"=>"Information Updated Successfully."]);
    }

}
