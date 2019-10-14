<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::resource('/notifications', 'api\NotificationController', ['only' => ['index', 'show']]);
/*
 * HR Module
 */

// user routes
Route::get('/users', 'api\UserController@index');
Route::post('/user/add', 'api\UserController@addNew');
Route::post('/login', 'api\LoginController@login');
Route::post('/update-user-image', 'api\UserController@updatePhoto');
Route::post('/change-password', 'api\UserController@changePassword');
Route::post('/reset-password', 'api\ForgotPasswordController@reset');
Route::post('/update-player-id', 'api\UserController@updatePlayerId');
Route::get('/user-info/{user_id}', 'api\UserController@userInfo');
Route::post('/update-user', 'api\UserController@updateUser');
Route::post('/delete-user/{user}', 'api\UserController@deleteAccount');


//Skills Route
Route::get('/skills', 'api\SkillController@index');
Route::get('/skill/{skill}/users', 'api\SkillController@skillUsers');

//Teams Route
Route::get('/departments', 'api\TeamController@index');
Route::get('/department/{team}/users', 'api\TeamController@teamUsers');

//Roles Route
Route::get('/roles', 'api\RoleController@index');
Route::get('/role/{role}/users', 'api\RoleController@roleUsers');

//Suppliers Route
Route::get('/suppliers', 'api\SupplierController@index');
Route::get('/supplier/{supplier}', 'api\SupplierController@show');


/*
 * Procurement Module
 */

//--post new procurement
Route::post('/procurement/create', 'api\ProcurementController@create');

//--Get user procurements
Route::get('/procurements/{user}', 'api\ProcurementController@show');

//--Show One procurement
Route::get('/procurement/{procurement}', 'api\ProcurementController@showProcurement');

//--Procurement Manager Show files
Route::get('/manager/{user}/procurements', 'api\ProcurementController@manager');

//--Add new Offer Price
Route::post('/offer-price/{procurement}/create', 'api\ProcurementController@addOffer');

//--Ask For Demo
Route::post('/procurement/{procurement}/demo', 'api\ProcurementController@demo');

//--Execute
Route::post('/procurement/{procurement}/execute', 'api\ProcurementController@execute');

//--Add new Log
Route::post('/log/{procurement}/create', 'api\ProcurementController@addLog');

/*
 * Social media module
 */

// posts Routes
Route::post('/posts', 'api\PostController@store');
Route::post('/corporate-posts', 'api\PostController@corporateStore');
Route::post('/update-post/{post}', 'api\PostController@update');
Route::get('/posts', 'api\PostController@index');
Route::post('/delete-post/{post}', 'api\PostController@destroy');
Route::get('/user/{user}/posts', 'api\PostController@userPosts');

// Reply Routes
Route::post('/reply/{reply}/update', 'api\ReplyController@update');
Route::post('/reply/{reply}/delete', 'api\ReplyController@destroy');
Route::get('/comment/{comment}/replies', 'api\ReplyController@index');
Route::post('/comment/{comment}/replies', 'api\ReplyController@store');


// comments Routes
Route::post('/post/{post}/comments', 'api\CommentController@store');
Route::post('/comment/{comment}/update', 'api\CommentController@update');
Route::post('/comment/{comment}/delete', 'api\CommentController@destroy');
Route::get('/post/{post}/comments', 'api\CommentController@index');

// Likes Routes
Route::post('/post/{post}/likes', 'api\LikeController@store');
Route::post('/like/{like}/delete', 'api\LikeController@destroy');
Route::get('/post/{post}/likes', 'api\LikeController@index');

// idea controller
Route::get('/my-ideas/{user}', 'api\IdeaController@getIdeas');
Route::post('/my-ideas', 'api\IdeaController@store');
Route::post('/idea-reply', 'api\IdeaController@reply')->name('idea.reply');
Route::post('/user/{user}/idea', 'api\IdeaController@deleteIdea');
Route::post('/idea/{idea}', 'api\IdeaController@viewIdea');


//Documents Routes
Route::get('/documents', 'api\DocumentController@index');
Route::post('/documents', 'api\DocumentController@store');
Route::get('/user/{user}/documents', 'api\DocumentController@userDocuments');
Route::post('/user/{user}/document', 'api\DocumentController@deleteDocument');

//Surveys Routes
Route::get('/surveys', 'api\SurveyController@getSurveys');
Route::get('/survey/{survey}', 'api\SurveyController@surveyInfo');
Route::post('/survey/{survey}', 'api\SurveyController@vote');

//Polls Routes
Route::get('/polls', 'api\SurveyController@getpolls');
Route::get('/poll/{survey}', 'api\SurveyController@surveyInfo');
Route::post('/poll/{survey}', 'api\SurveyController@vote');

//Polls Routes
Route::get('/uom', 'api\SurveyController@getUOM');
Route::get('/uom/{survey}', 'api\SurveyController@surveyInfo');
Route::post('/uom/{survey}', 'api\SurveyController@vote');

//Countries Route
Route::get('/countries', 'api\CountryController@index');
Route::get('/country/{country}/users', 'api\CountryController@countryUsers');