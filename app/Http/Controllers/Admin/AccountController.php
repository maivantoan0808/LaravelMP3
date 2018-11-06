<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Entities\User;
use App\Repositories\UserRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AccountRequestAccept;
use App\Notifications\AccountRequestRemove;

class AccountController extends Controller
{
    protected $repository;

    public function __construct(UserRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        $accounts = $this->repository->findByField('role_id', '4');
        return view('backend.admin.account_request.index', compact('accounts'));
    }

    public function accept($id)
    {
        $user = $this->repository->find($id);
        $user->role_id = 3;
        $user->save();
        Notification::route('mail', $user->email)->notify(new AccountRequestAccept());
        Toastr::success('Request Successfully Accepted', 'Success');
        return redirect()->back();
    }

    public function destroy($id)
    {
        $user = $this->repository->find($id);
        $user->role_id = 2;
        $user->save();
        Notification::route('mail', $user->email)->notify(new AccountRequestRemove());
        Toastr::success('Request Successfully Deleted', 'Success');
        return redirect()->back();
    }

}
