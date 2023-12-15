<?php

use App\Http\Controllers\Api\ArtistsController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PlaylistsController;
use App\Http\Controllers\Api\SongsController;
use App\Http\Controllers\Api\TokensController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Auth
Route::prefix('auth')->group(function () {
    
	//name, email, password, password_confirmation
	Route::post('signup', [AuthController::class,'signup'])->name('auth.signup');

	//email, password
	Route::post('login', [AuthController::class, 'login'])->name('auth.login');

	Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum')->name('auth.logout');
	Route::get('user', [AuthController::class, 'getAuthenticatedUser'])->middleware('auth:sanctum')->name('auth.user');

	//password, password_confirmation
	//OR
	//name, nickname,phone,email
	Route::post('user/update', [AuthController::class, 'updateAuthenticatedUser'])->middleware('auth:sanctum')->name('auth.user');

	//email
	Route::post('/password/email', [AuthController::class, 'sendPasswordResetLinkEmail'])->middleware('throttle:5,1')->name('password.email');

	//token(6 digits), email, password, password_confirmation
	Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('password.reset');
});




Route::middleware('auth:sanctum')->group(function () {

	//for artists/
	Route::prefix('artists')->group(function(){
		Route::get('random/{count?}', [ArtistsController::class, 'randomArtists']);
		Route::get('latest', [ArtistsController::class, 'latestArtists']);

		//paginated ouput
		Route::get('all/{count?}', [ArtistsController::class, 'allArtists']);

		//search
		Route::post('search/{count?}', [ArtistsController::class, 'searchArtists']);

		Route::get('view/{id}', [ArtistsController::class, 'viewArtist']);
	});
	
	//for playlists/
	Route::prefix('playlists')->group(function(){

		Route::get('random/{count?}', [PlaylistsController::class, 'randomPlaylists']);
		Route::get('latest', [PlaylistsController::class, 'latestPlaylists']);

		//paginated output
		Route::get('all/{count?}', [PlaylistsController::class, 'allPlaylists']);

		//search
		Route::post('search/{count?}', [PlaylistsController::class, 'searchPlaylists']);
		Route::get('view-playlist/{id}', [PlaylistsController::class, 'viewPlaylist']);
		Route::get('get-playlist-songs/{id}', [PlaylistsController::class, 'getPlaylistSongs']);

		Route::get('view-artist-playlist/{user_id}', [PlaylistsController::class, 'viewArtistPlaylist']);
		Route::get('view-user-playlist', [PlaylistsController::class, 'viewUserPlaylists']);
		
		//make use of confirmation prompt
		Route::get('selectPlaylist/{id}', [PlaylistsController::class, 'selectPlaylist']);
	});


	Route::prefix('songs')->group(function(){
		Route::get('get/{id}', [SongsController::class, 'getSong']);
		Route::get('get-song-reactions/{id}', [SongsController::class, 'getSongReactions']);

		//reaction is 1 or 0 for like or dislike
		Route::get('post-song-reaction/{id}/{reaction}', [SongsController::class, 'postSongReaction']);

	});


	Route::prefix('tokens')->group(function(){
		Route::get('wallet-history', [TokensController::class, 'walletHistory']);
		Route::get('get', [TokensController::class, 'getTokens']);
		Route::get('buy/{tx_ref}', [TokensController::class, 'buyToken']);
	});


});


