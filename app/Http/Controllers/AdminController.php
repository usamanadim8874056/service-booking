<?php

namespace App\Http\Controllers;

use Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;
use App\Models\GeneralSetting;
use App\Models\Category;
use App\Models\Service;
use App\Models\User;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    //
    public function index(Request $request)
    {

        if ($request->input()) {

            $request->validate([
                'username' => 'required',
                'password' => 'required',
            ]);
            // return Hash::make($request->input('password'));
            $login = Admin::where(['username' => $request->username])->pluck('password')->first();

            if (empty($login)) {
                return response()->json(['username' => 'Username Does not Exists']);
            } else {
                if (Hash::check($request->password, $login)) {
                    $admin = Admin::first();
                    $request->session()->put('admin', '1');
                    $request->session()->put('admin_name', $admin->admin_name);
                    return '1';
                } else {
                    return response()->json(['password' => 'Username and Password does not matched']);
                }
            }
        } else {
            return view('admin.admin');
        }
    }

    public function dashboard()
    {
        $category = Category::Select("*")->get();
        $categoryCount = $category->count();

        $service = Service::Select("*")->get();
        $serviceCount = $service->count();

        $userCount = User::where("user_type", 'user')->count();

        $providerCount = User::where("user_type", 'provider')->count();

        return view('admin.dashboard', ['category' => $categoryCount, 'service' => $serviceCount, 'user' => $userCount, 'provider' => $providerCount]);
    }

    public function logout(Request $req)
    {
        Auth::logout();
        session()->forget('admin');
        session()->forget('username');
        return '1';
    }
}
