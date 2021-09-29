<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{User};
use Auth;
use Spatie\Permission\Models\Role;

class pagescontroller extends Controller
{
    /**
     * request authetication for access to this controller
     */
    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * a funtion to check the role of user
     */
    public function check_if_admin() {
        if(Auth::check() && Auth::user()->hasRole('admin')) {
            return true;
        }
        return false;
    }
    public function index() {
        if(Auth::check() && Auth::user()->hasRole('admin')) {
            $users = User::orderBy('id', 'desc')->whereNotIn('id', [1])->get();
            return view('home',compact('users'));
        } else {
            Auth::logout();
            return redirect()->back()->with('status', 'Oops, you are not allowed to access this.');
        }
    }
    public function single_user($id) {
        //decode user id passed in url and check role
        if($this->check_if_admin() == false) return redirect()->back();
        $user = User::find(base64_decode($id));
        return view('pages.single_user',compact('user'));
    }
}
