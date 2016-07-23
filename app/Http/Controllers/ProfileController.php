<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use App\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    public function show(User $profile)
    {
        return view('profile.show', compact('profile'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $model = \Auth::user();
        $this->authorize('profileActions', $model);
        $sex_list = ['Неизвестный', 'Мужской', 'Женский'];

        return view('profile.edit', compact('model', 'sex_list'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\ProfileRequest $request, $id)
    {
        $user = \Auth::user();
        $this->authorize('profileActions', $user);
        $user->update($request->all());

        return redirect('/profile')->with('flash_success', 'Профайл успешно обновлен.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = \Auth::user();
        $this->authorize('profileActions', $user);
        $user->status = 'deleted';
        $user->save();

        return redirect('/')->with('flash_success', 'Вы успешно удалили себя.');
    }

    public function avatarCreate()
    {
        $this->authorize('profileActions', \Auth::user());
        return view('profile.avatar');
    }

    public function avatarStore(Request $request)
    {
        $this->authorize('profileActions', \Auth::user());
        $rules = ['avatar' => 'required|image|max:1000'];
        $validator = Validator::make(['avatar' => $request->avatar], $rules);
        if ($validator->passes()) {
            $destinationPath = base_path().config('app.uploads_avatar_path');
            $user = \Auth::user();

            // delete avatar
            $avatar = $destinationPath.'/'.$user->id.'/'.$user->avatar;
            if (file_exists($avatar)) {
                unlink($avatar);
            }

            $avatarExt = $request->avatar->getClientOriginalExtension();
            $avatarName = $user->id.'.'.$avatarExt;
            $user->avatar = $avatarName;
            $user->save();

            $request->avatar->move(
                $destinationPath.'/'.$user->id,
                $avatarName
            );
        } else {
            return redirect('/profile/avatar/create')
                ->withInput()->withErrors($validator);
        }
        return redirect('/profile')->with('flash_success', 'Аватар успешно загружен.');
    }

    public function avatarDestroy($id)
    {
        $this->authorize('profileActions', \Auth::user());
        $user = \Auth::user();
        $user->avatar = null;
        $user->save();

        $avatarsDir = base_path().config('app.uploads_avatar_path').'/'.$user->id;
        if (is_dir($avatarsDir)) {
            system("rm -rf ".escapeshellarg($avatarsDir));
        }
        // if (file_exists($avatarsDir.'/'.$user->avatar)) {
        //     unlink(realpath($avatarsDir.'/'.$user->avatar));
        // }

        return redirect('/profile/avatar/create')
            ->with('flash_success', 'Вы успешно удалили аватар.');
    }

    public function passwordEdit($id)
    {
        $this->authorize('profileActions', \Auth::user());
        $model = \Auth::user();

        return view('profile.password', compact('model'));
    }

    public function passwordUpdate(Request $request, $id)
    {
        $this->authorize('profileActions', \Auth::user());
        $rules = [
            'password' => 'required|password_equal',
            'new_password' => 'required|confirmed|min:6',
        ];
        $validator = Validator::make([
            'password' => $request->password,
            'new_password' => $request->new_password,
            'new_password_confirmation' => $request->new_password_confirmation,
        ], $rules);
        if ($validator->passes()) {
            $user = \Auth::user();
            $user->password = bcrypt($request->new_password);
            $user->save();
        } else {
            return redirect('/profile/password/'.$id)
                ->withInput()->withErrors($validator);
        }
        return redirect('/profile')
            ->with('flash_success', 'Пароль успешно изменен.');
    }

    public function getFriends()
    {
        return view('profile.friends');
    }

    public function accountActivate()
    {
        $user = \Auth::user();
        $this->authorize('activatedAccount', $user);
        $user->status = 'active';
        $user->save();

        return redirect('/profile')
            ->with('flash_success', 'Ваш аккаунт успешно активирован.');
    }
}
