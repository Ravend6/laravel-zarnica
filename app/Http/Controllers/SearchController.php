<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\User;

class SearchController extends Controller
{
    public function getIndex()
    {
        return view('search.index');
    }

    public function getUser()
    {
        $sex_list = ['Неизвестный', 'Мужской', 'Женский'];
        $sex_list[''] = 'Нет';

        return view('search.user', compact('sex_list'));
    }

    public function postUser(Request $request)
    {
        if ($request->name) {
            $users = User::where('name', 'like', '%'.$request->name.'%')->get();
        }

        if ($request->email) {
            $users = User::where('email', 'like', '%'.$request->email.'%')->get();
        }

        if ($request->sex) {
            $users = User::where('sex', $request->sex)->get();
        }

        if ($request->name and $request->email) {
            $users = User::where('name', 'like', '%'.$request->name.'%')
                ->where('email', 'like', '%'.$request->email.'%')->get();
        }

        if ($request->name and $request->email and $request->sex) {
            $users = User::where('name', 'like', '%'.$request->name.'%')
                ->where('email', 'like', '%'.$request->email.'%')
                ->where('sex', $request->sex)
                ->get();
        }

        if ($request->name and $request->sex) {
            $users = User::where('name', 'like', '%'.$request->name.'%')
                ->where('sex', $request->sex)
                ->get();
        }

        if ($request->email and  $request->sex) {
            $users = User::where('email', 'like', '%'.$request->email.'%')
                ->where('sex', $request->sex)
                ->get();
        }

        if ($request->sex == '0') {
            $users = User::where('sex', $request->sex)->get();
        }

        if ($request->sex == '0' and $request->name) {
            $users = User::where('name', 'like', '%'.$request->name.'%')
                ->where('sex', $request->sex)
                ->get();
        }

        if ($request->sex == '0' and $request->email) {
            $users = User::where('email', 'like', '%'.$request->email.'%')
                ->where('sex', $request->sex)
                ->get();
        }

        if ($request->sex == '0' and $request->name and $request->email) {
            $users = User::where('name', 'like', '%'.$request->name.'%')
                ->where('email', 'like', '%'.$request->email.'%')
                ->where('sex', $request->sex)
                ->get();
        }


        if (!isset($users)) $users = null;

        return redirect('/search/user')->with('users', $users)->withInput();
        // $rules = [
        //     'name' => 'required',
        //     // 'email' => '',
        // ];
        // $validator = Validator::make([
        //     'name' => $request->name,
        // ], $rules);
        // if ($validator->passes()) {
        //     $users = User::where('name', 'like', '%'.$request->name.'%')->get();
        //     // dd($users);
        //     return redirect('/search/user')->with('users', $users)->withInput();
        // } else {
        //     return redirect('/search/user')
        //         ->withInput()->withErrors($validator);
        // }
    }
}
