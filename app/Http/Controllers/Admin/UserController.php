<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = User::paginate(10);
        $model = new User;
        $model->name = '';
        $model->email = '';
        $roles = Role::lists('name', 'id');
        $roles[''] = 'нет';

        return view('admin.user.index', compact('models', 'model', 'roles'));
    }

    public function postSearch(Request $request)
    {
        if (!$request->name and !$request->email) {
            $models = User::paginate(10);
        }
        if ($request->name) {
            $models = User::where('name', 'like', '%'.$request->name.'%')->paginate(10);
        }
        if ($request->email) {
            $models = User::where('email', 'like', '%'.$request->email.'%')->paginate(10);
        }
        if ($request->name and $request->email) {
            $models = User::where('name', 'like', '%'.$request->name.'%')
                ->where('email', 'like', '%'.$request->email.'%')->paginate(10);
        }
        if ($request->role_list) {
            $models = Role::find($request->role_list)->users()->paginate(10);
        }
        if ($request->role_list and $request->name) {
            $models = Role::find($request->role_list)
                ->users()
                ->where('name', 'like', '%'.$request->name.'%')
                ->paginate(10);
        }
        if ($request->role_list and $request->email) {
            $models = Role::find($request->role_list)
                ->users()
                ->where('email', 'like', '%'.$request->email.'%')
                ->paginate(10);
        }
        if ($request->role_list and $request->email and $request->name) {
            $models = Role::find($request->role_list)
                ->users()
                ->where('name', 'like', '%'.$request->name.'%')
                ->where('email', 'like', '%'.$request->email.'%')
                ->paginate(10);
        }
        $model = new User;
        $model->name = $request->name;
        $model->email = $request->email;
        $model->role_list = $request->role_list;
        $roles = Role::lists('name', 'id');
        $roles[''] = 'нет';

        return view('admin.user.index', compact('models', 'model', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $model = $user;
        $roles = Role::lists('name', 'id');
        $sex_list = ['Неизвестный', 'Мужской', 'Женский'];

        return view('admin.user.edit', compact('model', 'roles', 'sex_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\Admin\UserRequest $request, User $user)
    {
        $data = $request->all();
        if ($request->password) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }
        $user->update($data);
        $user->roles()->sync($request->input('role_list'));

        return redirect('/admin/user')
            ->with('flash_success', 'Пользователь успешно обновлен.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if ($user->avatar) {
            $avatarDir = base_path().config('app.uploads_avatar_path').'/'.$user->id;
            if (is_dir($avatarDir)) {
                system("rm -rf ".escapeshellarg($avatarDir));
            }
        }
        $user->delete();
        return redirect('/admin/user')
            ->with('flash_success', 'Пользователь успешно удален.');
    }

    public function destroyAvatar(User $user)
    {
        $user->avatar = null;
        $user->save();

        $avatarDir = base_path().config('app.uploads_avatar_path').'/'.$user->id;
        if (is_dir($avatarDir)) {
            system("rm -rf ".escapeshellarg($avatarDir));
        }

        return back()
            ->with('flash_success', 'Аватар успешно удален.');
    }
}
