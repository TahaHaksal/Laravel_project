<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminPanelController extends Controller
{
    public function view_users()
    {
        $users = User::all()->except(Auth::id());
        return view('admin_panel', [
            'users' => $users
        ]);
    }

    public function store($id)
    {
        $user = User::where('id', '=', $id)->get()->first();
        return view('single_user', [
            'user' => $user,
        ]);
    }

    public function change(Request $request, $id)
    {
        if (!$request->hasAny(['fname', 'email', 'isadmin']))
            return redirect('/');
        $request->validate([
                'fname' => 'nullable',
                'email' => 'email|nullable',
                'isadmin' => 'numeric|max:1|nullable'
            ]);
        if ($request->filled('fname'))
        {
            User::find($id)->where('id', '=', $id)->update([
                'name' => $request->input('fname'),
            ]);
        }
        if ($request->filled('email'))
        {
            User::find($id)->where('id', '=', $id)->update([
                'email' => $request->input('email'),
            ]);
        }
        if ($request->filled('isadmin'))
        {
            User::find($id)->where('id', '=', $id)->update([
                'is_admin' => $request->input('isadmin'),
            ]);
        }
        return redirect('/admin-panel');
    }

    public function delete($id)
    {
        User::find($id)->delete();
        return redirect('/admin-panel');
    }

    public function create(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
            'is_admin' => 'nullable|numeric|max:1',
        ]);
        $id = DB::table('users')->insertGetId([
            'name' => $request->input('fname'),
            'email' => $request->input('email'),
            'is_admin' => $request->input('isadmin'),
            'password' => Hash::make($request->password),
        ]);
        return redirect('/admin-panel');
    }
}
