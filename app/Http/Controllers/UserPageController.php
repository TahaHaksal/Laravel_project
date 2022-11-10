<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserPageModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class UserPageController extends Controller
{
    public function user_pages_view()
    {
        $user = Auth::user();
        $pages = User::find($user->id)->pages()->simplePaginate(10);

        return view('user_pages', [
            'user' => $user,
            'pages' => $pages,
        ]);
    }

    public function single_page_view($page_id)
    {
        $user = Auth::user();
        $page = User::find($user->id)->first()->page($page_id)->first();
        $avg_reading_time = 0;
        if (!empty($page->title))
        {
            $word_count = str_word_count($page->description);
            $avg_reading_time = number_format($word_count / 250, 1)." - ".number_format($word_count / 200, 1)." minutes average reading time";
        }
        return view('single_user_page', [
            'user' => $user,
            'page' => $page,
            'avg_reading' => $avg_reading_time,
        ]);
    }

    public function user_create_page( Request $request )
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);
        $signed_status = $request->signed;
        if ($signed_status === '1')
            $signed_status = true;
        else
            $signed_status = false;
        UserPageModel::create([
            'title' => $request->title,
            'description' => $request->description,
            'signed' => $signed_status,
            'customer_id' => Auth::user()->id,
        ]);
        return redirect('/user-pages');
    }

    public function delete_page( Request $request )
    {
        $page = UserPageModel::find($request->id);
        $page->delete();
        return redirect('/user-pages');
    }

    public function edit_page( Request $request )
    {
        $user = Auth::user();
        $request->validate([
            'title' => 'nullable',
            'description' => 'nullable',
        ]);
        $signed_status = $request->signed;
        if ($signed_status === '1')
            $signed_status = true;
        else
            $signed_status = false;
        $page = UserPageModel::find($user->id);
        if (!empty($request->title))
            $page->title = $request->title;
        if (!empty($request->description))
            $page->description = $request->description;
        $page->signed = $signed_status;
        $page->save();
        return redirect('/user-pages');
    }
}
