<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// Route::get('/', function () {
//     return view('welcome');
// })->middleware(['web', 'guest']);

// $router->get('/call', function () {
//     // config(['my.path' => 'aa']);
//     // $my = config('my.path');
//     //
//     // return 'call '.csrf_token();
//     return 'call';
// });

// $router->get('/api', function () {
//     return view('api');
// });
//
// Route::group(['prefix' => 'api'], function () {
//     Route::resource('authenticate', 'AuthenticateController', ['only' => ['index']]);
//     Route::post('authenticate', 'AuthenticateController@authenticate');
//     Route::get('user/name', 'AuthenticateController@getName');
// });
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['prefix' => 'admin', 'middleware' => ['web']], function () {
    Route::get('/', [
        'as' => 'admin.page.index',
        'uses' => 'Admin\PageController@getIndex']);
    // User
    Route::resource('user', 'Admin\UserController', [
        'except' => ['show', 'create', 'store']]);
    Route::post('user', [
        'as' => 'admin.user.search',
        'uses' => 'Admin\UserController@postSearch']);
    Route::delete('user/avatar/{user}', [
        'as' => 'admin.user.avatar.destroy',
        'uses' => 'Admin\UserController@destroyAvatar']);
    // Role
    Route::resource('role', 'Admin\RoleController');
    // Tag
    Route::resource('tag', 'Admin\TagController');
    // Article
    Route::resource('article', 'Admin\ArticleController', [
        'only' => ['index', 'destroy']]);
    // Banned
    Route::resource('banned', 'Admin\BannedController');
});

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    // Route::get('test', function () {
    //     return Auth::user()->roles;
    // });

    // Page
    Route::get('/', [
        'as' => 'page.index',
        'uses' => 'PageController@getIndex']);
    Route::get('/plan', [
        'as' => 'page.plan',
        'uses' => 'PageController@getPlan']);
    Route::get('/chat', [
        'as' => 'page.chat',
        'uses' => 'PageController@getChat']);

    // Search
    Route::get('search',[
        'as' => 'search.index',
        'uses' => 'SearchController@getIndex']);
    Route::get('search/user',[
        'as' => 'search.user.index',
        'uses' => 'SearchController@getUser']);
    Route::post('search/user',[
        'as' => 'search.user.store',
        'uses' => 'SearchController@postUser']);

    // Profile
    Route::get('profile/friends',[
        'as' => 'profile.friends',
        'uses' => 'ProfileController@getFriends']);
    Route::get('/profile/avatar/create', [
        'as' => 'profile.avatar.create',
        'uses' => 'ProfileController@avatarCreate']);
    Route::post('/profile/avatar', [
        'as' => 'profile.avatar.store',
        'uses' => 'ProfileController@avatarStore']);
    Route::delete('/profile/avatar/{avatar}', [
        'as' => 'profile.avatar.destroy',
        'uses' => 'ProfileController@avatarDestroy']);
    Route::get('/profile/password/{password}', [
        'as' => 'profile.password.edit',
        'uses' => 'ProfileController@passwordEdit']);
    Route::patch('/profile/password/{password}', [
        'as' => 'profile.password.update',
        'uses' => 'ProfileController@passwordUpdate']);
    Route::get('/profile/account/activate', [
        'as' => 'profile.account.activate',
        'uses' => 'ProfileController@accountActivate']);

    Route::resource('profile', 'ProfileController', [
        'except' => ['create', 'store']]);

    // Friend
    Route::get('friend/add/{friend}',[
        'as' => 'friend.add',
        'uses' => 'FriendController@getAdd']);
    Route::get('friend/remove/{friend}',[
        'as' => 'friend.remove',
        'uses' => 'FriendController@getRemove']);
    // Route::get('friend/confirm',[
    //     'as' => 'friend.confirm',
    //     'uses' => 'FriendController@getConfirm']);
    Route::get('friend/confirm/add/{friend}',[
        'as' => 'friend.confirm.add',
        'uses' => 'FriendController@getConfrimAdd']);

    // Message
    Route::get('message',[
        'as' => 'message.index',
        'uses' => 'MessageController@index']);
    Route::get('message/{user}/send',[
        'as' => 'message.send',
        'uses' => 'MessageController@getSend']);
    Route::post('message/{user}/send',[
        'as' => 'message.send.store',
        'uses' => 'MessageController@postSend']);
    Route::delete('message/{message}',[
        'as' => 'message.destroy',
        'uses' => 'MessageController@destroy']);

    // Route::resource('message', 'MessageController');

    // Article
    Route::resource('article', 'ArticleController', [
        'except' => ['destroy']]);
    Route::delete('article/avatar/{article}', [
        'as' => 'article.avatar.destroy',
        'uses' => 'ArticleController@destroyImage']);

    // Tag
    Route::get('tag/{tag}',[
        'as' => 'tag.show',
        'uses' => 'TagController@show']);

    // Comment
    Route::resource('comment', 'CommentController', [
        'except' => ['index', 'show', 'create']]);

    // Banned
    Route::post('banned/chat/{user}',[
        'as' => 'banned.chat.user',
        'uses' => 'BannedController@postUserChat']);


});
