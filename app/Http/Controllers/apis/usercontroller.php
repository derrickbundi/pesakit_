<?php

namespace App\Http\Controllers\apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\{User};
use Illuminate\Support\Facades\Validator;
use Hash;
use Spatie\Permission\Models\Role;

class usercontroller extends Controller
{
    /**
     * login user
     */
    public function login(Request $request) {
        $exist = User::where('email', $request->email)->first();
        //check if email exist, if it does not return error
        if(!$exist) return _httpBadRequest('Oops, email address doesn\'t exists');
        //generate token
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $name = $user->name;
            $mobile = $user->mobile;
            $token = _Token($user->email, $request->password);
            return _httpOk(compact('token', 'name', 'mobile'));
        }
        return _httpBadRequest('Invalid Credentials.');
    }
    /**
     * register user
     */
    public function register(Request $request) {
        //validate data received from endpoint
        $validator = Validator::make($request->all(), [
            'name' => 'min:3',
            'mobile' => 'digits:10',
            'email'  => 'unique:users'
        ]);
        if($validator->fails()) {
            return _httpBadRequest($validator);
        }
        $data = [
            'name' => $request->name,
            'mobile' => '254'.substr($request->mobile,-9),
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ];
        //create user
        $user = User::create($data);
        //assign role
        $role = Role::find(2);
        $permissions = [2];
        $role->syncPermissions($permissions);
        $user->assignRole([$role->id]);

        return _httpCreated('User created successfully,');
    }
    /**
     * view personal details
     */
    public function profile_view() {
        //authetication token should be passed on http request headers
        $detail = User::where('id',Auth::user()->id)->first();
        return _httpOk($detail);
    }
}
