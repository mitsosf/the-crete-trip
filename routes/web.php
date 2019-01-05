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
if(env('APP_ENV','production') === 'production'){
    URL::forceScheme('https');
}

Route::get('/','HomeController@index')->name('home');//
Route::get('/welcome','HomeController@welcome')->name('welcome');//
Route::get('/home','HomeController@index')->name('home.old');
Route::get('/terms','HomeController@terms')->name('terms');
Route::get('/faq','HomeController@faq')->name('faq');

Auth::routes();
//Temp for registrations end
Route::get('/register','Auth\RegisterController@showRegistrationForm')->name('register');
//Late
Route::get('/late','Auth\RegisterController@showRegistrationForm')->name('late');


//Participant routes
Route::get('/account', 'Participants\ParticipantController@index')->name('participants.home');
Route::get('/account/pay', 'Participants\ParticipantController@pay')->name('participants.pay');
Route::get('/account/faq', 'Participants\ParticipantController@faq')->name('participants.faq');
Route::get('/account/terms', 'Participants\ParticipantController@terms')->name('participants.terms');
Route::post('/account/editesncard', 'Participants\ParticipantController@editEsnCard')->name('participants.editesncard');
Route::get('/account/rooming', 'Participants\ParticipantController@rooming')->name('participants.rooming');
Route::get('/account/rooming/createRoom', 'Participants\ParticipantController@createRoom')->name('participants.createRoom');
Route::post('/account/rooming/doCreateRoom', 'Participants\ParticipantController@doCreateRoom')->name('participants.doCreateRoom');
Route::get('/account/rooming/joinRoom', 'Participants\ParticipantController@joinRoom')->name('participants.joinRoom');
Route::post('/account/rooming/doJoinRoom', 'Participants\ParticipantController@doJoinRoom')->name('participants.doJoinRoom');
Route::get('/account/rooming/randomRoom', 'Participants\ParticipantController@randomRoom')->name('participants.randomRoom');
Route::post('/account/rooming/doRandomRoom', 'Participants\ParticipantController@doRandomRoom')->name('participants.doRandomRoom');
Route::get('/account/rooming/viewDetails/{id}', 'Participants\ParticipantController@viewRoommateDetails')->name('participants.viewRoommateDetails');
Route::get('/account/logout', 'Participants\ParticipantController@logout')->name('participants.logout');


//LC-GL routes
Route::get('/manage/', 'LCs\LCController@manage')->name('lc.manage');
Route::get('/manage/admin', 'LCs\LCController@index')->name('lc.home');  //access as LC/GL
Route::get('/manage/asParticipant', 'LCs\LCController@asParticipant')->name('lc.asParticipant');  //access as participant
Route::get('/manage/participant/{id}', 'LCs\LCController@participant')->name('lc.participant');
Route::get('/manage/statistics', 'LCs\LCController@statistics')->name('lc.statistics');
Route::post('/manage/editesncard', 'LCs\LCController@editEsnCard')->name('lc.editesncard');
Route::post('/manage/editparticipantesncard', 'LCs\LCController@editParticipantEsnCard')->name('lc.editparticipantesncard');
Route::get('/manage/bank', 'LCs\LCController@bank')->name('lc.bank');
Route::get('/manage/uploadProof', 'LCs\LCController@uploadProof')->name('lc.uploadProof');
Route::get('/manage/myPayments', 'LCs\LCController@myPayments')->name('lc.myPayments');
Route::post('/manage/doUploadProof', 'LCs\LCController@doUploadProof')->name('lc.doUploadProof');
Route::get('/manage/payFee/{id}', 'LCs\LCController@payFee')->name('lc.payFee');
Route::get('/manage/doPayFee/{id}', 'LCs\LCController@doPayFee')->name('lc.doPayFee');
Route::get('/manage/payFerry/{id}', 'LCs\LCController@payFerry')->name('lc.payFerry');
Route::post('/manage/doPayFerry', 'LCs\LCController@doPayFerry')->name('lc.doPayFerry');
Route::get('/manage/waitingList/{id}', 'LCs\LCController@waitingList')->name('lc.waitingList');
Route::get('/manage/boat/toCrete', 'LCs\LCController@boatToCrete')->name('lc.boatToCrete');
Route::get('/manage/boat/fromCrete', 'LCs\LCController@boatFromCrete')->name('lc.boatFromCrete');
Route::get('/manage/exportParticipants', 'LCs\LCController@exportParticipants')->name('lc.exports.participants');
Route::get('/manage/logout', 'LCs\LCController@logout')->name('lc.logout');


//OC routes
Route::get('/godmode', 'OC\OCController@index')->name('oc.home');
Route::get('/godmode/registrations', 'OC\OCController@registrations')->name('oc.registrations');
Route::get('/godmode/sections', 'OC\OCController@sections')->name('oc.sections');
Route::get('/godmode/proofs', 'OC\OCController@proofs')->name('oc.proofs');
Route::get('/godmode/doApprovePayment/{id}', 'OC\OCController@doApprovePayment')->name('oc.doApprovePayment');
Route::get('/godmode/asSection/{sectionName}', 'OC\OCController@asSection')->name('oc.asSection');
Route::get('/godmode/asParticipant/{id}', 'OC\OCController@asParticipant')->name('oc.asParticipant');
Route::get('/godmode/cashflow', 'OC\OCController@cashflow')->name('oc.cashflow');
Route::get('/godmode/ckeckin/marilena', 'OC\OCController@marilena')->name('oc.marilena');
Route::get('/godmode/ckeckin/marirena', 'OC\OCController@marirena')->name('oc.marirena');
Route::get('/godmode/ckeckin/heraklion', 'OC\OCController@heraklion')->name('oc.heraklion');
Route::get('/godmode/checkin/{id}', 'OC\OCController@checkin')->name('oc.checkin');
Route::get('/godmode/doCheckin/{id}', 'OC\OCController@doCheckin')->name('oc.doCheckin');
Route::get('/godmode/uncheckin/{id}', 'OC\OCController@uncheckin')->name('oc.uncheckin');
Route::get('/godmode/doUncheckin/{id}', 'OC\OCController@doUncheckin')->name('oc.doUncheckin');
Route::get('/godmode/rooming', 'OC\OCController@rooming')->name('oc.rooming');
Route::get('/godmode/viewRoomOccupants/{id}', 'OC\OCController@viewRoomOccupants')->name('oc.viewRoomOccupants');
Route::get('/godmode/viewParticipant/{id}', 'OC\OCController@viewParticipant')->name('oc.viewParticipant');
Route::get('/godmode/ckeckin/welcomeBags', 'OC\OCController@welcomeBags')->name('oc.welcomeBags');
Route::get('/godmode/checkin/giveWelcomeBag/{id}', 'OC\OCController@giveWelcomeBag')->name('oc.giveWelcomeBag');
Route::get('/godmode/checkin/doGiveWelcomeBag/{id}', 'OC\OCController@doGiveWelcomeBag')->name('oc.doGiveWelcomeBag');
Route::get('/godmode/logout', 'OC\OCController@logout')->name('oc.logout');
