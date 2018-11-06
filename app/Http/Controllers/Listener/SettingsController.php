<?php

namespace App\Http\Controllers\Listener;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class SettingsController extends Controller
{
    public function index()
    {
        return view('backend.listener.settings');
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request,[
            'image' => 'required|image',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->name);
        $user = User::findOrFail(Auth::id());
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imageName = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('profile/listener')) {
                Storage::disk('public')->makeDirectory('profile/listener');
            }
            //Delete old image form profile folder
            if (Storage::disk('public')->exists('profile/listener/'.$user->image)) {
                Storage::disk('public')->delete('profile/listener/'.$user->image);
            }
            $profile = Image::make($image)->resize(500,500)->save();
            Storage::disk('public')->put('profile/listener/'.$imageName,$profile);
        } else {
            $imageName = $user->image;
        }
        $user->birthday = date_create($request->birthday);
        $user->country = $request->country;
        $user->image = $imageName;
        $user->about = $request->about;
        $user->save();
        Toastr::success('Profile Successfully Updated :)','Success');
        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request,[
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);
        $hashedPassword = Auth::user()->password;
        if (Hash::check($request->old_password,$hashedPassword)) {
            if (!Hash::check($request->password,$hashedPassword)) {
                $user = User::find(Auth::id());
                $user->password = Hash::make($request->password);
                $user->save();
                Toastr::success('Password Successfully Changed, Please Login Again','Success');
                Auth::logout();
                return redirect()->route('login');
            } else {
                Toastr::error('New password cannot be the same as old password.','Error');
                return redirect()->back();
            }
        } else {
            Toastr::error('Current password not match.','Error');
            return redirect()->back();
        }
    }
}
