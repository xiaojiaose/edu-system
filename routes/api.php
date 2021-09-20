<?php

use App\Http\Middleware\IdentityFilter;

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
Route::post('auth/login', 'Api\AuthController@login');
Route::post('auth/reg', 'Api\AuthController@register');
//Route::get('test', function (Request $request) {
//    return $request->user();
//});

Route::middleware('auth:api')->group(function () {
    Route::middleware(IdentityFilter::class . ":" . \App\Teacher::class)->group(function () {
        // 老师创建/查询学校
        Route::any('/schools', 'Api\SchoolController@schools');
        // 老师创建/查询某个学校学生
        Route::any('/schools/{schoolId}/students', 'Api\SchoolController@students');
        Route::get('/teachers/students', 'Api\SchoolController@students');
        // 管理员邀请老师
        Route::post('/schools/{schoolId}/invites', 'Api\SchoolController@invites');
        // 老师查看关注自己的学生
        Route::get('/teachers/students/subscribe', 'Api\TeacherController@subscribe');
        Route::post('/talk/teacher/{studentId}', 'Api\TalkMsgController@teacherTalk');
    });

    Route::middleware(IdentityFilter::class . ":" . \App\Student::class)->group(function () {
        Route::get('/students/school', 'Api\StudentController@schoolInfo');
        // 学生学校的老师们
        Route::get('/students/teachers', 'Api\StudentController@teachers');
        // 学生关注老师及列表
        Route::get('/students/subscribes', 'Api\StudentController@subscribeList');
        Route::post('/students/subscribes/{teacherId}', 'Api\StudentController@subscribe');
        Route::delete('/students/unsubscribes/{teacherId}', 'Api\StudentController@deleteSubscribe');
        Route::post('/talk/student/{teacherId}', 'Api\TalkMsgController@studentTalk');
    });

});