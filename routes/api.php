<?php

use App\Http\Controllers\Api\LessonController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RelationshipController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\UserController;
use App\Models\Lesson;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([],function(){
    Route::apiResources(['/lessons'=>LessonController::class]);
    Route::apiResources(['/users'=>UserController::class]);
    Route::apiResources(['/tags'=>TagController::class]);
});




// Realations ///

Route::get('/user/{id}/lessons',[RelationshipController::class , 'userLessons']);
Route::get('/lesson/{id}/tags',[RelationshipController::class , 'lessonTags']);
Route::get('/tag/{id}/lessons',[RelationshipController::class , 'tagLessons']);

// login //
Route::get('/login' , [LoginController::class , 'login'])->name('login');


Route::any('/lesson',function()
{
    return Response::json(["message"=>"Please enter the correct name"] , 404);
});

// Route::redirect('lesson','lessons');
