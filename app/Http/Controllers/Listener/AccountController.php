<?php

namespace App\Http\Controllers\Listener;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Brian2694\Toastr\Facades\Toastr;
use App\Entities\User;
use App\Http\Requests\AccountRequest;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NewAccountRequest;

class AccountController extends Controller
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return view('backend.listener.account.index');
    }

    public function update(AccountRequest $request)
    {
        if ($request->email == Auth::user()->email) {
            if (Auth::user()->role_id == 4) {
                Toastr::info('Your Account Successfully Requested, Wait Admin to Accept', 'Info');
                return redirect()->back();
            } else {
                Auth::user()->role_id = 4;
                Auth::user()->save();

                $users = User::where('role_id','1')->get();
                foreach ($users as $user) {
                    Notification::route('mail', $user->email)->notify(new NewAccountRequest());
                }

                Toastr::success('Your Account Successfully Requested, Wait Admin to Accept', 'Success');
                return redirect()->route('listener.dashboard');
            }
        } else {
            Toastr::error('Your Account Wrong! Please enter your account', 'Error');
            return redirect()->back();
        }
    }

}
