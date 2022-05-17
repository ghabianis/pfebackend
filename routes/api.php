<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MailController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


// public endpoints
Route::get('/hello', function () {
    return ':)';
});
Route::get('/mail', function()
{
    return ':)';
});
// Route::get('/check', [App\Http\Controllers\UserController::class,'check']);
// protected endpoints

Route::get('sendbasicemail',[App\Http\Controllers\MailController::class,'basic_email']);
Route::get('sendattachmentemail',[App\Http\Controllers\MailController::class,'attachment_email']);



Route::group(['middleware' => 'auth:api'], function () {
    Route::post('announcement',[App\Http\Controllers\MailController::class,'announcement']);
    Route::get('getAnnouncement',[App\Http\Controllers\MailController::class,'getAnnouncement']);
    Route::delete('DeleteAnnouncement/{id}',[App\Http\Controllers\MailController::class,'DeleteAnnouncement']);
    Route::post('makeReport',[App\Http\Controllers\reclamationController::class,'makeReport']);
    Route::get('getReports/{id}',[App\Http\Controllers\reclamationController::class,'getReports']);
    Route::post('addSurvey',[App\Http\Controllers\reclamationController::class,'addSurvey']);
    Route::post('addMaterial',[App\Http\Controllers\Reservations::class,'addMaterial']);
    Route::get('getMaterial',[App\Http\Controllers\Reservations::class,'getMaterial']);


    Route::get('getAllReports',[App\Http\Controllers\reclamationController::class,'getAllReports']);

    Route::delete('deleteReports/{id}',[App\Http\Controllers\reclamationController::class,'deleteReports']);

    Route::get('getReportsByStatus/{userId}',[App\Http\Controllers\reclamationController::class,'getReportsByStatus']);

    Route::get('updateReportsStatus/{id}',[App\Http\Controllers\reclamationController::class,'updateReportsStatus']);

    Route::post('sendhtmlemail',[App\Http\Controllers\MailController::class,'html_email']);

    Route::get('/check/{userId}', [App\Http\Controllers\UserController::class,'check']);
    Route::post('/Reclamation', [App\Http\Controllers\reclamationController::class,'Reclamation']);
    Route::get('/getReclamations/{userId}', [App\Http\Controllers\reclamationController::class,'getReclamations'])->middleware('auth:api');
    Route::get('/getAllReclamations', [App\Http\Controllers\reclamationController::class,'getAllReclamations'])->middleware('auth:api');
    Route::get('/updateStatus/{userId}', [App\Http\Controllers\reclamationController::class,'updateStatus'])->middleware('auth:api');

    Route::post('/AddProfileInfo', [App\Http\Controllers\profileController::class,'AddProfileInfo'])->middleware('auth:api');
    Route::put('/getProfileUpdatedInfo/{userId}', [App\Http\Controllers\profileController::class,'getProfileUpdatedInfo'])->middleware('auth:api');
    Route::get('/getUserInfo/{userId}', [App\Http\Controllers\profileController::class,'getUserInfo'])->middleware('auth:api');



    Route::get('/getCalanderInfo/{userId}', [App\Http\Controllers\reclamationController::class,'getCalanderInfo'])->middleware('auth:api');
    Route::post('/addToDOTask', [App\Http\Controllers\reclamationController::class,'addToDOTask'])->middleware('auth:api');
    Route::get('/getToDOTask/{userId}', [App\Http\Controllers\reclamationController::class,'getToDOTask'])->middleware('auth:api');
    Route::get('/getAllToDOTask', [App\Http\Controllers\reclamationController::class,'getAllToDOTask'])->middleware('auth:api');
    Route::get('/updateTaskStatus/{userId}', [App\Http\Controllers\reclamationController::class,'updateTaskStatus'])->middleware('auth:api');
    // Route::delete('/DeleteTask/{userId}', [App\Http\Controllers\reclamationController::class,'DeleteTask'])->middleware('auth:api');
    Route::put('/updateUserProfile/{userId}', [App\Http\Controllers\reclamationController::class,'updateUserProfile'])->middleware('auth:api');
    Route::post('/userProfileInfo', [App\Http\Controllers\reclamationController::class,'userProfileInfo'])->middleware('auth:api');
    Route::get('/gettUserInfo/{userId}', [App\Http\Controllers\reclamationController::class,'gettUserInfo'])->middleware('auth:api');
    Route::get('/updatePorfileStatusInfo/{userId}', [App\Http\Controllers\reclamationController::class,'updatePorfileStatusInfo'])->middleware('auth:api');
    Route::post('/reportUser', [App\Http\Controllers\UserController::class,'reportUser'])->middleware('auth:api');

    Route::post('/MoreSettings', [App\Http\Controllers\profileController::class,'MoreSettings'])->middleware('auth:api');
    Route::get('/getExtraSettings/{userId}', [App\Http\Controllers\profileController::class,'getExtraSettings'])->middleware('auth:api');
    // Tasks parte
    Route::post('/AddTask', [App\Http\Controllers\UserController::class,'AddTask'])->middleware('auth:api');
    Route::get('/getAllTask', [App\Http\Controllers\UserController::class,'getAllTask'])->middleware('auth:api');
    Route::get('/getTaskById/{userId}', [App\Http\Controllers\UserController::class,'getTaskById'])->middleware('auth:api');
    Route::get('/updateTaskActiveStatus/{id}', [App\Http\Controllers\UserController::class,'updateTaskActiveStatus'])->middleware('auth:api');
    Route::get('/updateTaskPausedStatus/{id}', [App\Http\Controllers\UserController::class,'updateTaskPausedStatus'])->middleware('auth:api');
    Route::get('/updateTaskCompletedStatus/{id}', [App\Http\Controllers\UserController::class,'updateTaskCompletedStatus'])->middleware('auth:api');
    Route::get('/getTaskEvent', [App\Http\Controllers\UserController::class,'getTaskEvent'])->middleware('auth:api');
    Route::delete('/DeleteTask/{id}', [App\Http\Controllers\UserController::class,'DeleteTask'])->middleware('auth:api');



// Reservations API
Route::post('/makeReservation', [App\Http\Controllers\Reservations::class,'makeReservation'])->middleware('auth:api');
Route::get('/getAllReservations', [App\Http\Controllers\Reservations::class,'getAllReservations'])->middleware('auth:api');
Route::get('/getReservationsById/{userId}', [App\Http\Controllers\Reservations::class,'getReservationsById'])->middleware('auth:api');
Route::get('/RejectReservation/{userId}', [App\Http\Controllers\Reservations::class,'RejectReservation'])->middleware('auth:api');
Route::get('/AcceptReservations/{userId}', [App\Http\Controllers\Reservations::class,'AcceptReservations'])->middleware('auth:api');
Route::delete('/DeleteReservation/{userId}', [App\Http\Controllers\Reservations::class,'DeleteReservation'])->middleware('auth:api');
Route::put('/updateReservations/{userId}', [App\Http\Controllers\Reservations::class,'updateReservations'])->middleware('auth:api');
Route::get('/getReservationsTime/{userId}', [App\Http\Controllers\Reservations::class,'getReservationsTime'])->middleware('auth:api');



// Time Booking apis
Route::post('/MakeBreakBooking', [App\Http\Controllers\booking::class,'MakeBreakBooking'])->middleware('auth:api');
Route::get('/getAllMakeBreakBooking', [App\Http\Controllers\booking::class,'getAllMakeBreakBooking'])->middleware('auth:api');
Route::get('/getMakeBreakBookingById/{userId}', [App\Http\Controllers\booking::class,'getMakeBreakBookingById'])->middleware('auth:api');
Route::get('/AcceptBookings/{id}', [App\Http\Controllers\booking::class,'AcceptBookings'])->middleware('auth:api');
Route::get('/rejectBookings/{id}', [App\Http\Controllers\booking::class,'rejectBookings'])->middleware('auth:api');
Route::get('/getBreakBookingsCalanderInfo/{userId}', [App\Http\Controllers\booking::class,'getBreakBookingsCalanderInfo'])->middleware('auth:api');

//department apis
Route::post('/addepartement', [App\Http\Controllers\UserController::class,'addepartement'])->middleware('auth:api');
Route::get('/getAllDepartements', [App\Http\Controllers\UserController::class,'getAllDepartements'])->middleware('auth:api');

// forum control api
Route::post('/addQuestion', [App\Http\Controllers\forumController::class,'addQuestion'])->middleware('auth:api');
Route::get('/getQuestions', [App\Http\Controllers\forumController::class,'getQuestions'])->middleware('auth:api');
Route::post('/relpyQuestion/{id}', [App\Http\Controllers\forumController::class,'relpyQuestion'])->middleware('auth:api');
Route::get('/getReplys/{id}', [App\Http\Controllers\forumController::class,'getReplys'])->middleware('auth:api');
Route::get('/addLike/{id}', [App\Http\Controllers\forumController::class,'addLike'])->middleware('auth:api');


// work from home API
Route::post('/MakeWorkFromHomeBooking', [App\Http\Controllers\workfromhomesController::class,'MakeWorkFromHomeBooking'])->middleware('auth:api');
Route::get('/getAWllWorkFromHomeBookings', [App\Http\Controllers\workfromhomesController::class,'getAllWorkFromHomeBookings'])->middleware('auth:api');
Route::get('/getAllWorkFromHomeBookingsById/{id}', [App\Http\Controllers\workfromhomesController::class,'getAllWorkFromHomeBookingsById'])->middleware('auth:api');
Route::get('/AcceptedWorkFromHomeBookings/{id}', [App\Http\Controllers\workfromhomesController::class,'AcceptedWorkFromHomeBookings'])->middleware('auth:api');
Route::get('/RejectedWorkFromHomeBookings/{id}', [App\Http\Controllers\workfromhomesController::class,'RejectedWorkFromHomeBookings'])->middleware('auth:api');
Route::get('/getWorkFromHomeBookingsForCalender', [App\Http\Controllers\workfromhomesController::class,'getWorkFromHomeBookingsForCalender'])->middleware('auth:api');
Route::get('/workFromHomeCalender/{userId}', [App\Http\Controllers\workfromhomesController::class,'workFromHomeCalender'])->middleware('auth:api');

// training APIS
Route::post('/addTraining', [App\Http\Controllers\trainingController::class,'addTraining'])->middleware('auth:api');
Route::get('/getAllTraining', [App\Http\Controllers\trainingController::class,'getAllTraining'])->middleware('auth:api');
Route::get('/getTrainingsById/{id}', [App\Http\Controllers\trainingController::class,'getTrainingsById'])->middleware('auth:api');
Route::get('/AcceptTrainingRequest/{id}', [App\Http\Controllers\trainingController::class,'AcceptTrainingRequest'])->middleware('auth:api');
Route::get('/RejectTrainingRequest/{id}', [App\Http\Controllers\trainingController::class,'RejectTrainingRequest'])->middleware('auth:api');
Route::get('/subscribeTraining/{id}', [App\Http\Controllers\trainingController::class,'subscribeTraining'])->middleware('auth:api');
Route::get('/numberOfScubscribers/{id}', [App\Http\Controllers\trainingController::class,'numberOfScubscribers'])->middleware('auth:api');
Route::delete('/deleteTraining/{id}', [App\Http\Controllers\trainingController::class,'deleteTraining'])->middleware('auth:api');
Route::post('/addSubscription', [App\Http\Controllers\trainingController::class,'addSubscription'])->middleware('auth:api');
Route::get('/getAllSubs', [App\Http\Controllers\trainingController::class,'getAllSubs'])->middleware('auth:api');
Route::get('/getSubscriptionsBYId/{userId}', [App\Http\Controllers\trainingController::class,'getSubscriptionsBYId'])->middleware('auth:api');
// courses
Route::get('/getlaravelCourses', [App\Http\Controllers\trainingController::class,'getlaravelCourses'])->middleware('auth:api');
Route::get('/getreactCourses', [App\Http\Controllers\trainingController::class,'getreactCourses'])->middleware('auth:api');
Route::get('/getphpCourses', [App\Http\Controllers\trainingController::class,'getphpCourses'])->middleware('auth:api');
Route::get('/getcpulsCourses', [App\Http\Controllers\trainingController::class,'getcpulsCourses'])->middleware('auth:api');
Route::get('/getcsharpCourses', [App\Http\Controllers\trainingController::class,'getcsharpCourses'])->middleware('auth:api');
Route::get('/getvueCourses', [App\Http\Controllers\trainingController::class,'getvueCourses'])->middleware('auth:api');
Route::get('/getnodeCourses', [App\Http\Controllers\trainingController::class,'getnodeCourses'])->middleware('auth:api');

// external courses APIS
Route::post('/ExternalCourseRequest', [App\Http\Controllers\trainingController::class,'ExternalCourseRequest'])->middleware('auth:api');
Route::get('/getExternalCourses/{userId}', [App\Http\Controllers\trainingController::class,'getExternalCourses'])->middleware('auth:api');
Route::get('/acceptRequest/{id}', [App\Http\Controllers\trainingController::class,'acceptRequest'])->middleware('auth:api');
Route::get('/rejectRequest/{id}', [App\Http\Controllers\trainingController::class,'rejectRequest'])->middleware('auth:api');

Route::get('/getAllSubscriptions', [App\Http\Controllers\trainingController::class,'getAllSubscriptions'])->middleware('auth:api');
Route::get('/acceptExteranlRequest/{id}', [App\Http\Controllers\trainingController::class,'acceptExteranlRequest'])->middleware('auth:api');
Route::get('/rejectExteranlRequest/{id}', [App\Http\Controllers\trainingController::class,'rejectExteranlRequest'])->middleware('auth:api');
Route::get('/getAllExternalRequests', [App\Http\Controllers\trainingController::class,'getAllExternalRequests'])->middleware('auth:api');






Route::get('/getAngularCourses', [App\Http\Controllers\trainingController::class,'getAngularCourses'])->middleware('auth:api');









    Route::delete('/deleteReclamation/{userId}', [App\Http\Controllers\reclamationController::class,'deleteReclamation'])->middleware('auth:api');
    Route::get('/updatereject/{userId}', [App\Http\Controllers\reclamationController::class,'updatereject'])->middleware('auth:api');


    // more endpoints ...
    Route::post('/register', [App\Http\Controllers\UserController::class,'register']);
        Route::get('/protected', function () {
            return Auth::token();
        });
});

