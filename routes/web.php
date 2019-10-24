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

use App\Event;
use Carbon\Carbon;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/home', function () {
    return view('home2');
});


Auth::routes();


/*
 * Admin Panel Routes & Auth
 */

Route::middleware(['admin'])->prefix('admin')->group(function () {

    Route::get('/home', 'HomeController@index')->name('home');
    // Uses first & second Middleware
    Route::resource('/users', 'UserController');
    Route::get('/user/{user}/edit', 'UserController@change')->name('user.edit');


    //IDEA Routes
    Route::resource('/idea', 'IdeaController');
    Route::post('/idea-reply', 'IdeaController@reply')->name('idea.reply');

    //skills Routes
    Route::resource('/skill', 'SkillController');

    //Roles Routes
    Route::resource('/role', 'RoleController');
    Route::get('/role/{role}/employees', 'RoleController@teamUsers')->name('role.users');


    //Department Routes
    Route::resource('/department', 'TeamController');
    Route::get('/department/{team}/employees', 'TeamController@teamUsers')->name('team.users');

    //Suppliers Routes
    Route::resource('/suppliers', 'SupplierController');

    //Surveys Routes
    Route::resource('/survey', 'SurveyController');
    Route::get('/survey/{survey}/answers/create', 'SurveyController@AnswerCreate')->name('answer.index');
    Route::post('/answer', 'SurveyController@AnswerStore')->name('answer.store');
    Route::delete('/answer/{answer}', 'SurveyController@AnswerDelete')->name('answer.delete');

    //Polls Routes
    Route::resource('/poll', 'PollController');
    Route::get('/poll/{survey}/answers/create', 'PollController@AnswerCreate')->name('answer.poll-index');

    //EmployeeOfTheMonth Routes
    Route::resource('/employee-of-the-month', 'EmployeeOfTheMonthController');
    Route::get('/employee-of-the-month/{survey}/users/add', 'EmployeeOfTheMonthController@AnswerCreate')->name('answer.employee-index');
    Route::post('/employee-of-the-month-users', 'EmployeeOfTheMonthController@AnswerStore')->name('answer.storeUsers');


    //Procurements Routes
    Route::resource('/po', 'ProcurementController');
    Route::get('/all-pos', 'ProcurementController@all')->name('po.all');
    Route::get('/demo-pos', 'ProcurementController@allDemo')->name('po.alldemo');
    Route::get('/execute-pos', 'ProcurementController@allExecute')->name('po.allexecute');
    Route::get('/po/{procurement}/reply', 'ProcurementController@reply')->name('po.reply');
    Route::get('/po/{procurement}/manage', 'ProcurementController@manage')->name('po.manage');
    Route::get('/po/{procurement}/demo', 'ProcurementController@demo')->name('po.demo');
    Route::get('/po/{procurement}/execute', 'ProcurementController@execute')->name('po.execute');
    Route::resource('/offerPrice', 'OfferPriceController');
    Route::resource('/ProcurementLog', 'ProcurementLogController');

    //News Feed

    Route::get('/newsfeed', function (){
        $posts = \App\Post::where('type', 0)->latest()->get();
        return view('news-feeds', compact('posts'));
    })->name('newsfeed.index');

    Route::get('/corporate-news', function (){
        $posts = \App\Post::where('type', 1)->latest()->get();
        return view('corporate-news', compact('posts'));
    })->name('newsfeed.corporate');;

    Route::get('/corporate', 'CorporateController@index')->name('corporate.index');
    Route::post('/corporate', 'CorporateController@store')->name('corporate.store');


    //Activate and Deactivate Users Route
    Route::patch('/users/{user}/activate', 'UserController@activate')->name('users.activate');
    Route::patch('/users/{user}/deactivate', 'UserController@deactivate')->name('users.deactivate');
    Route::patch('/user/{user}/update', 'UserController@updateUser')->name('user.updateUser');
    Route::get('/users/{user}/change-password', 'UserController@changePassword')->name('users.changePassword');
    Route::patch('/users/{user}/update-password', 'UserController@updatePassword')->name('users.updatePassword');
    Route::get('/user-log/{user}', 'UserController@userLog')->name('user.log');



    //account settings
    Route::get('/account', 'AccountController@index')->name('account.index');
    Route::get('/chat', 'UserController@chat')->name('chat');
    Route::get('/my-documents/{user}', 'DocumentController@index')->name('document.my');
    Route::resource('/document', 'DocumentController');

//Country Routes
    Route::resource('/country', 'CountryController');

//    Holiday Routes
    Route::resource('/holidays', 'HolidayController');

//    Mission Routes
    Route::resource('/missions', 'MissionController');
    Route::get('/users/missions/hr', 'MissionController@hr')->name('missions.hr');

//    Vacation Routes
    Route::resource('/vacations', 'VacationController');
    Route::get('/users/vacations/hr', 'VacationController@hr')->name('vacations.hr');

//    Request Routes
    Route::resource('/request/forms', 'RequestFormController');
    Route::resource('/request/{form}/elements', 'RequestElementController');

    Route::resource('/request/tasks', 'TaskController');
    Route::get('/change/request-form', 'TaskController@changeForm')->name('tasks.change-form');
    Route::get('/tasks/user/requests', 'TaskController@userRequests')->name('tasks.user-requests');
    Route::get('/tasks/accounts/reviews', 'TaskController@accountsReviews')->name('tasks.accounts-reviews');


});
