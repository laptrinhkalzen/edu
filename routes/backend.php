<?php

use Illuminate\Support\Facades\Route;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
  Route::get('/index', ['as' => 'admin.index', 'uses' => 'Backend\BackendController@index']);
  /* Cấu hình website */
  Route::get('/config', ['as' => 'admin.config.index', 'uses' => 'Backend\ConfigController@index']);
  Route::post('/config/update/{id}', ['as' => 'admin.config.update', 'uses' => 'Backend\ConfigController@update']);



  /* Quản lý video */
  Route::get('/video', ['as' => 'admin.video.index', 'uses' => 'Backend\VideoController@index']);
  Route::get('/video/create', ['as' => 'admin.video.create', 'uses' => 'Backend\VideoController@create']);
  Route::post('/video/store', ['as' => 'admin.video.store', 'uses' => 'Backend\VideoController@store']);
  Route::get('/video/edit/{id}', ['as' => 'admin.video.edit', 'uses' => 'Backend\VideoController@edit']);
  Route::post('/video/update/{id}', ['as' => 'admin.video.update', 'uses' => 'Backend\VideoController@update']);
  Route::delete('/video/delete/{id}', ['as' => 'admin.video.destroy', 'uses' => 'Backend\VideoController@destroy']);
  Route::post('/video/update_multiple', ['as' => 'admin.video.update_multiple', 'uses' => 'Backend\VideoController@update_multiple']);

  /* Quản lý news */
  Route::get('/news', ['as' => 'admin.news.index', 'uses' => 'Backend\NewsController@index']);
  Route::get('/news/create', ['as' => 'admin.news.create', 'uses' => 'Backend\NewsController@create']);
  Route::post('/news/store', ['as' => 'admin.news.store', 'uses' => 'Backend\NewsController@store']);
  Route::get('/news/edit/{id}', ['as' => 'admin.news.edit', 'uses' => 'Backend\NewsController@edit']);
  Route::post('/news/update/{id}', ['as' => 'admin.news.update', 'uses' => 'Backend\NewsController@update']);
  Route::delete('/news/delete/{id}', ['as' => 'admin.news.destroy', 'uses' => 'Backend\NewsController@destroy']);
  Route::post('/news/update_multiple', ['as' => 'admin.news.update_multiple', 'uses' => 'Backend\NewsController@update_multiple']);
  /* Quản lý danh mục */
  Route::get('/category/{type}', ['as' => 'admin.category.index', 'uses' => 'Backend\CategoryController@index']);
  Route::get('/category/{type}/create', ['as' => 'admin.category.create', 'uses' => 'Backend\CategoryController@create']);
  Route::get('/category/{type}/edit/{id}', ['as' => 'admin.category.edit', 'uses' => 'Backend\CategoryController@edit']);
  Route::post('/category/{type}/store', ['as' => 'admin.category.store', 'uses' => 'Backend\CategoryController@store']);
  Route::post('/category/{type}/update/{id}', ['as' => 'admin.category.update', 'uses' => 'Backend\CategoryController@update']);
  Route::delete('/category/{type}/delete/{id}', ['as' => 'admin.category.destroy', 'uses' => 'Backend\CategoryController@destroy']);
  /* Quản lý khoá học */
  Route::get('course/test/{type?}', ['as' => 'admin.course.index', 'uses' => 'Backend\CourseController@index']);
  Route::get('/course/{type?}/create', ['as' => 'admin.course.create', 'uses' => 'Backend\CourseController@create']);
  Route::post('/course/{type?}/store', ['as' => 'admin.course.store', 'uses' => 'Backend\CourseController@store']);
  Route::get('/course/{type?}/edit/{id}', ['as' => 'admin.course.edit', 'uses' => 'Backend\CourseController@edit']);
  Route::post('/course/{type?}/update/{id}', ['as' => 'admin.course.update', 'uses' => 'Backend\CourseController@update']);
  Route::delete('/course/{type?}/delete/{id}', ['as' => 'admin.course.destroy', 'uses' => 'Backend\CourseController@destroy']);
  Route::post('/course/update_multiple', ['as' => 'admin.course.update_multiple', 'uses' => 'Backend\CourseController@update_multiple']);






  /* Quản lý test */
  Route::get('/test', ['as' => 'admin.test.index', 'uses' => 'Backend\TestController@index']);
  Route::get('/test/create', ['as' => 'admin.test.create', 'uses' => 'Backend\TestController@create']);
  Route::post('/test/store', ['as' => 'admin.test.store', 'uses' => 'Backend\TestController@store']);
  Route::get('/test/edit/{id}', ['as' => 'admin.test.edit', 'uses' => 'Backend\TestController@edit']);
  Route::post('/test/update/{id}', ['as' => 'admin.test.update', 'uses' => 'Backend\TestController@update']);
  Route::delete('/test/delete/{id}', ['as' => 'admin.test.destroy', 'uses' => 'Backend\TestController@destroy']);



  /* Quản lý câu hỏi */
  Route::get('/question', ['as' => 'admin.question.index', 'uses' => 'Backend\QuestionController@index']);
  // Route::get('/question/create', ['as' => 'admin.question.create', 'uses' => 'Backend\QuestionController@create']);
  Route::post('/question/store', ['as' => 'admin.question.store', 'uses' => 'Backend\QuestionController@store']);
  Route::get('/question/edit/{id}', ['as' => 'admin.question.edit', 'uses' => 'Backend\QuestionController@edit']);
  Route::post('/question/update/{id}', ['as' => 'admin.question.update', 'uses' => 'Backend\QuestionController@update']);
  Route::delete('/question/delete/{id}', ['as' => 'admin.question.destroy', 'uses' => 'Backend\QuestionController@destroy']);

  /* Quản lý quizz */
  Route::get('/quizz', ['as' => 'admin.quizz.index', 'uses' => 'Backend\QuizzController@index']);
  Route::get('/quizz/create', ['as' => 'admin.quizz.create', 'uses' => 'Backend\QuizzController@create']);
  Route::post('/quizz/store', ['as' => 'admin.quizz.store', 'uses' => 'Backend\QuizzController@store']);
  Route::get('/quizz/edit/{id}', ['as' => 'admin.quizz.edit', 'uses' => 'Backend\QuizzController@edit']);
  Route::post('/quizz/update/{id}', ['as' => 'admin.quizz.update', 'uses' => 'Backend\QuizzController@update']);
  Route::delete('/quizz/delete/{id}', ['as' => 'admin.quizz.destroy', 'uses' => 'Backend\QuizzController@destroy']);

  /* Quản lý attribute */
  Route::get('/attribute', ['as' => 'admin.attribute.index', 'uses' => 'Backend\AttributeController@index']);
  Route::get('/attribute/create', ['as' => 'admin.attribute.create', 'uses' => 'Backend\AttributeController@create']);
  Route::post('/attribute/store', ['as' => 'admin.attribute.store', 'uses' => 'Backend\AttributeController@store']);
  Route::get('/attribute/edit/{id}', ['as' => 'admin.attribute.edit', 'uses' => 'Backend\AttributeController@edit']);
  Route::post('/attribute/update/{id}', ['as' => 'admin.attribute.update', 'uses' => 'Backend\AttributeController@update']);
  Route::delete('/attribute/delete/{id}', ['as' => 'admin.attribute.destroy', 'uses' => 'Backend\AttributeController@destroy']);





  /* Quản lý user */
  Route::get('/user', ['as' => 'admin.user.index', 'uses' => 'Backend\UserController@index']);
  Route::get('/user/create', ['as' => 'admin.user.create', 'uses' => 'Backend\UserController@create']);
  Route::post('/user/store', ['as' => 'admin.user.store', 'uses' => 'Backend\UserController@store']);
  Route::get('/user/edit/{id}', ['as' => 'admin.user.edit', 'uses' => 'Backend\UserController@edit']);
  Route::post('/user/update/{id}', ['as' => 'admin.user.update', 'uses' => 'Backend\UserController@update']);
  Route::delete('/user/delete/{id}', ['as' => 'admin.user.destroy', 'uses' => 'Backend\UserController@destroy']);

  Route::get('/user/edit_profile/{id}', ['as' => 'admin.user.index_profile', 'uses' => 'Backend\UserController@editProfile']);
  Route::post('/user/update_profile/{id}', ['as' => 'admin.user.update_profile', 'uses' => 'Backend\UserController@updateProfile']);
  /* Quản lý quyền */
  Route::get('/role', ['as' => 'admin.role.index', 'uses' => 'Backend\RoleController@index']);
  Route::get('/role/create', ['as' => 'admin.role.create', 'uses' => 'Backend\RoleController@create']);
  Route::get('/role/edit/{id}', ['as' => 'admin.role.edit', 'uses' => 'Backend\RoleController@edit']);
  Route::post('/role/store', ['as' => 'admin.role.store', 'uses' => 'Backend\RoleController@store']);
  Route::post('/role/update/{id}', ['as' => 'admin.role.update', 'uses' => 'Backend\RoleController@update']);
  Route::delete('/role/delete/{id}', ['as' => 'admin.role.destroy', 'uses' => 'Backend\RoleController@destroy']);

  //about
  Route::get('/about', ['as' => 'admin.about.index', 'uses' => 'Backend\AboutController@index']);
  Route::get('/about/edit/{id}', ['as' => 'admin.about.edit', 'uses' => 'Backend\AboutController@edit']);
  Route::post('/about/update/{id}', ['as' => 'admin.about.update', 'uses' => 'Backend\AboutController@update']);



  //section
  Route::get('/section', ['as' => 'admin.section.index', 'uses' => 'Backend\SectionController@index']);
  Route::get('/section/create', ['as' => 'admin.section.create', 'uses' => 'Backend\SectionController@create']);
  Route::get('/section/edit/{id}', ['as' => 'admin.section.edit', 'uses' => 'Backend\SectionController@edit']);
  Route::post('/section/store', ['as' => 'admin.section.store', 'uses' => 'Backend\SectionController@store']);
  Route::post('/section/update/{id}', ['as' => 'admin.section.update', 'uses' => 'Backend\SectionController@update']);
  Route::post('/section/delete/{id}', ['as' => 'admin.section.destroy', 'uses' => 'Backend\SectionController@destroy']);
  Route::post('/section/update_multiple', ['as' => 'admin.section.update_multiple', 'uses' => 'Backend\SectionController@update_multiple']);




  /* Quản lý giảng viên */
  Route::get('/teacher', ['as' => 'admin.teacher.index', 'uses' => 'Backend\TeacherController@index']);
  Route::get('/teacher/create', ['as' => 'admin.teacher.create', 'uses' => 'Backend\TeacherController@create']);
  Route::post('/teacher/store', ['as' => 'admin.teacher.store', 'uses' => 'Backend\TeacherController@store']);
  Route::get('/teacher/edit/{id}', ['as' => 'admin.teacher.edit', 'uses' => 'Backend\TeacherController@edit']);
  Route::post('/teacher/update/{id}', ['as' => 'admin.teacher.update', 'uses' => 'Backend\TeacherController@update']);
  Route::delete('/teacher/delete/{id}', ['as' => 'admin.teacher.destroy', 'uses' => 'Backend\TeacherController@destroy']);
  Route::post('/teacher/update_multiple', ['as' => 'admin.teacher.update_multiple', 'uses' => 'Backend\TeacherController@update_multiple']);

  /* Quản lý địa chỉ liên hệ */
  Route::get('/contact_address', ['as' => 'admin.contact_address.index', 'uses' => 'Backend\ContactAddressController@index']);
  Route::get('/contact_address/create', ['as' => 'admin.contact_address.create', 'uses' => 'Backend\ContactAddressController@create']);
  Route::post('/contact_address/store', ['as' => 'admin.contact_address.store', 'uses' => 'Backend\ContactAddressController@store']);
  Route::get('/contact_address/edit/{id}', ['as' => 'admin.contact_address.edit', 'uses' => 'Backend\ContactAddressController@edit']);
  Route::post('/contact_address/update/{id}', ['as' => 'admin.contact_address.update', 'uses' => 'Backend\ContactAddressController@update']);
  Route::delete('/contact_address/delete/{id}', ['as' => 'admin.contact_address.destroy', 'uses' => 'Backend\ContactAddressController@destroy']);
  Route::post('/contact_address/update_multiple', ['as' => 'admin.contact_address.update_multiple', 'uses' => 'Backend\ContactAddressController@update_multiple']);




  /*Lịch */
  Route::get('/schedule', ['as' => 'admin.schedule.index', 'uses' => 'Backend\ScheduleController@index']);
  Route::get('/schedule/create', ['as' => 'admin.schedule.create', 'uses' => 'Backend\ScheduleController@create']);
  Route::get('/schedule/edit/{id}', ['as' => 'admin.schedule.edit', 'uses' => 'Backend\ScheduleController@edit']);
  Route::post('/schedule/store', ['as' => 'admin.schedule.store', 'uses' => 'Backend\ScheduleController@store']);
  Route::post('/schedule/update/{id}', ['as' => 'admin.schedule.update', 'uses' => 'Backend\ScheduleController@update']);
  Route::delete('/schedule/{id}', ['as' => 'admin.schedule.destroy', 'uses' => 'Backend\ScheduleController@destroy']);
  Route::post('/schedule/update_multiple', ['as' => 'admin.schedule.update_multiple', 'uses' => 'Backend\ScheduleController@update_multiple']);






  Route::get('/score', ['as' => 'admin.score.index', 'uses' => 'Backend\ScoreController@index']);
  Route::get('/score/create/{type}', ['as' => 'admin.score.create', 'uses' => 'Backend\ScoreController@create']);
  Route::get('/score/edit/{id}', ['as' => 'admin.score.edit', 'uses' => 'Backend\ScoreController@edit']);
  Route::post('/score/{type}/store', ['as' => 'admin.score.store', 'uses' => 'Backend\ScoreController@store']);
  Route::post('/score/update/{id}', ['as' => 'admin.score.update', 'uses' => 'Backend\ScoreController@update']);
  Route::delete('/score/delete/{id}', ['as' => 'admin.score.destroy', 'uses' => 'Backend\ScoreController@destroy']);

  Route::get('/rule', ['as' => 'admin.rule.index', 'uses' => 'Backend\RuleController@index']);
  Route::get('/rule/create', ['as' => 'admin.rule.create', 'uses' => 'Backend\RuleController@create']);
  Route::get('/rule/edit/{id}', ['as' => 'admin.rule.edit', 'uses' => 'Backend\RuleController@edit']);
  Route::post('/rule/store', ['as' => 'admin.rule.store', 'uses' => 'Backend\RuleController@store']);
  Route::post('/rule/update/{id}', ['as' => 'admin.rule.update', 'uses' => 'Backend\RuleController@update']);
  Route::delete('/rule/delete/{id}', ['as' => 'admin.rule.destroy', 'uses' => 'Backend\RuleController@destroy']);

  Route::post('/update-teacher-status', ['as' => 'admin.update_status', 'uses' => 'Backend\UpdateStatus@updateTeacherStatus']);
});
