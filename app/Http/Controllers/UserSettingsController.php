<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserSettingsController extends Controller
{
    public function view()
    {
        $user = Auth::user();
        return view('user_settings', [
            'user' => $user,
        ]);
    }

    public function change_password_view()
    {
        return view('change_password');
    }

    public function change_password(Request $request)
    {
        $request->validate(
            [
                'old_password' => 'required',
                'new_password' => 'required|confirmed',
                'new_password_confirmation' => 'required',
                ]
            );
        $user = Auth::user();
        if (password_verify($request->old_password, $user['password']) && !strcmp($request->new_password, $request->new_password_confirmation))
        {
            DB::table('users')->where('email', '=', $user['email'])->update(['password' => Hash::make($request->new_password)]);
        }
        return redirect('/user-settings');
    }

    public function update(Request $request)
    {

        $request->validate([
            'fname' => 'nullable|max:256',
            'email' => 'nullable|unique:users,email',
        ]);
        $user = Auth::user();
        if ($request->has('fname') && !empty($request->fname))
        {
            DB::table('users')->where('email', '=', $user->email)->update(['name' => $request->fname]);
        }
        if ($request->has('email') && !empty($request->email))
        {
            DB::table('users')->where('email', '=', $user->email)->update(['email' => $request->email]);
        }
        return redirect('/user-settings');
    }

    public function delete()
    {
        $user = Auth::user();
        DB::table('users')->where('email', '=', $user['email'])->delete();
        return redirect('/login');
    }
}
