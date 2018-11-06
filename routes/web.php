<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group(['middleware' => 'localization', 'prefix' => Session::get('locale')], function() {
    Route::post('/lang', [
        'as' => 'switchLang',
        'uses' => 'LangController@postLang',
    ]);

    Route::get('/', 'HomeController@index')->name('home');

    Route::get('404.html', ['as' => 'errors', 'uses' => 'HomeController@pageError']);

    Route::get('/search', 'SearchController@search');

    Route::get('/song/list/all', 'SongController@index')->name('song.list.all');
    Route::get('/song/list/{slug}', 'SongController@getSongByCategory')->name('song.list.by.category');
    Route::get('/song/{slug}.html', 'SongController@getSongDetails')->name('song.details');
    Route::post('/store-comment-song/{id}','SongController@storeComment')->name('store.comment.song');

    Route::get('/artist/list/all', 'SingerController@index')->name('singer.list.all');
    Route::get('/artist/{username}.html', 'SingerController@show')->name('singer.details');
    Route::get('/artist/{username}/song', 'SingerController@getSongOfSinger')->name('song.of.singer');

    Route::post('/follow/{user}', 'FollowController@add')->name('follow');
    Route::delete('/unfollow/{user}', 'FollowController@remove')->name('unfollow');

    Route::post('/like/song/{song}', 'LikeController@createLikeSong')->name('like.song');
    Route::delete('/unlike/song/{song}', 'LikeController@destroyLikeSong')->name('unlike.song');
    Route::post('/like/album/{album}', 'LikeController@createLikeAlbum')->name('like.album');
    Route::delete('/unlike/album/{album}', 'LikeController@destroyLikeAlbum')->name('unlike.album');

    Route::get('/album/list/all', 'AlbumController@index')->name('album.list.all');
    Route::get('/album/{slug}.html', 'AlbumController@getAlbumDetails')->name('album.details');
    Route::post('/store-comment-album/{id}','AlbumController@storeComment')->name('store.comment.album');
    Route::get('/artist/{username}/album', 'SingerController@getAlbumOfSinger')->name('album.of.singer');

    Route::get('/{username}/myplaylist', 'PlaylistController@index')->name('myplaylist');
    Route::get('/{username}/myplaylist/{slug}.html', 'PlaylistController@show')->name('myplaylist.show');
    Route::post('/{username}/myplaylist/store/new', 'PlaylistController@storeNewPlaylist')->name('myplaylist.store.new');
    Route::post('/{username}/myplaylist/store/{id}', 'PlaylistController@store')->name('myplaylist.store');
    Route::post('/{username}/myplaylist/song/store/{id}', 'PlaylistController@storeSong')->name('myplaylist.song.store');

    Route::get('/download-normal-song/{id}/{file}', 'DownloadController@downloadNormal')->name('download.normal');

    Route::get('auth/{provider}', 'Auth\LoginController@redirectToProvider');
    Route::get('auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

    Route::get('/test/{slug}', 'HomeController@download')->name('download');

    Auth::routes();

    Route::group([
        'as' => 'admin.',
        'prefix' => 'admin', 
        'namespace' => 'Admin', 
        'middleware' => ['auth', 'admin']], function(){
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        
        Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('logs');

        Route::resource('category', 'CategoryController');
        Route::resource('singer', 'SingerController');
        Route::resource('listener', 'ListenerController');
        Route::resource('song', 'SongController');

        Route::get('account', 'AccountController@index')->name('account.index');
        Route::post('account/accept/{id}', 'AccountController@accept')->name('account.accept');
        Route::delete('account/delete/{id}', 'AccountController@destroy')->name('account.destroy');
    });

    Route::group([
        'as' => 'singer.',
        'prefix' => 'singer', 
        'namespace' => 'Singer', 
        'middleware' => ['auth', 'singer']], function(){
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        
        Route::get('settings','SettingsController@index')->name('settings');
        Route::put('profile-update','SettingsController@updateProfile')->name('profile.update');
        Route::put('password-update','SettingsController@updatePassword')->name('password.update');

        Route::resource('song', 'SongController');
        Route::resource('album', 'AlbumController');
        
    });

    Route::group([
        'as' => 'listener.',
        'prefix' => 'listener', 
        'namespace' => 'Listener', 
        'middleware' => ['auth', 'listener']], function(){
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        
        Route::get('account', 'AccountController@index')->name('account');
        Route::put('account', 'AccountController@update')->name('account.update');

        Route::get('playlist-manage','PlaylistController@index')->name('playlist.manage');
        Route::delete('playlist/delete/{id}', 'PlaylistController@destroy')->name('playlist.destroy');
        Route::get('playlist-show/{id}','PlaylistController@show')->name('playlist.show');
        Route::delete('playlist/delete/song/{id}', 'PlaylistController@destroySong')->name('playlist.destroy.song');

        Route::get('settings','SettingsController@index')->name('settings');
        Route::put('profile-update','SettingsController@updateProfile')->name('profile.update');
        Route::put('password-update','SettingsController@updatePassword')->name('password.update');
    });
});