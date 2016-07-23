<?php

use App\Lib\Message;
use App\User;

if (!function_exists('delete_to_route')) {
    function delete_to_route($params, $buttonText = 'Удалить') {
        $form = Form::open(['route' => $params, 'method' => 'delete']);
        $form .= '<button type="submit" class="btn btn-danger btn-sm" '.
            'onclick="return confirm(\'Вы действительно хотите удалить?\');">'.
            '<i class="fa fa-btn fa-trash-o"></i>'.$buttonText.'</button>';
        // $form .= Form::submit($buttonText, [
        //     'class' => 'btn btn-danger btn-sm',
        //     'onclick' => 'return confirm("Вы действительно хотите удалить?");']);
        $form .= Form::close();
        return $form;
    }
}

if (!function_exists('update_to_route')) {
    function edit_to_route($route, $params) {
        $href = '<a class="btn btn-primary btn-sm" href="'. route($route, $params).
            '"><i class="fa fa-btn fa-pencil-square-o"></i>Редактировать</a>';
        return $href;
    }
}

if (!function_exists('delete_to_route_with_lang')) {
    function delete_to_route_with_lang($params) {
        $form = Form::open(['route' => $params, 'method' => 'delete']);
        $form .= Form::submit(trans('messages.button_delete'), [
            'class' => 'btn btn-danger btn-sm',
            'onclick' => 'return confirm("' . trans('messages.delete_confirm') .'");']);
        $form .= Form::close();
        return $form;
    }
}

if (!function_exists('is_admin_role')) {
    function is_admin_role(User $user) {
        foreach ($user->roles as $role) {
            if ($role->name === 'admin') {
                return true;
            }
        }
        return false;
    }
}

if (!function_exists('is_newsmaker_role')) {
    function is_newsmaker_role(User $user) {
        foreach ($user->roles as $role) {
            if ($role->name === 'newsmaker') {
                return true;
            }
        }
        return false;
    }
}



// if (!function_exists('lang_check')) {
//     function lang_check($lang) {
//         if (in_array($lang, config('app.list_locales'))) {
//             if ($lang == \App::getLocale()) return;
//             \App::setLocale($lang);
//         } else {
//             abort(404);
//         }
//     }
// }
