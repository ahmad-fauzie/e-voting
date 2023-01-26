<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KandidatController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\VotingController;
use App\Http\Controllers\HasilController;
use App\Http\Controllers\WaktuController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ChatsController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\SettingController;

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

Route::get('/', [AuthController::class, 'index'])->name('login');
Route::post('/proses_login', [AuthController::class, 'proses_login'])->name('proses_login');
Route::get('/daftar', [AuthController::class, 'register'])->name('register');
Route::post('/proses_register', [AuthController::class, 'proses_register'])->name('proses_register');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/sidebar', [AuthController::class, 'sidebar'])->name('sidebar');

Route::get('forget-password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
Route::post('forget-password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post'); 
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

Route::get('/hasil', [HasilController::class, 'index'])->name('hasil.index');
Route::get('/hasil/fetchall', [HasilController::class, 'fetchAll'])->name('hasil.fetchAll');

Route::group(['middleware' => ['auth']], function () {
    Route::group(['middleware' => ['cek_login:admin']], function () {
        Route::get('/kandidat', [KandidatController::class, 'index'])->name('kandidat.index');
        Route::post('/kandidat/store', [KandidatController::class, 'store'])->name('kandidat.store');
        Route::get('/kandidat/fetchall', [KandidatController::class, 'fetchAll'])->name('kandidat.fetchAll');
        Route::delete('/kandidat/delete', [KandidatController::class, 'delete'])->name('kandidat.delete');
        Route::delete('/kandidat/deleteAll', [KandidatController::class, 'deleteAll'])->name('kandidat.deleteAll');
        Route::get('/kandidat/edit', [KandidatController::class, 'edit'])->name('kandidat.edit');
        Route::post('/kandidat/update', [KandidatController::class, 'update'])->name('kandidat.update');
        
        Route::get('/siswa', [SiswaController::class, 'index'])->name('siswa.index');
        Route::post('/siswa/store', [SiswaController::class, 'store'])->name('siswa.store');
        Route::get('/siswa/export', [SiswaController::class, 'export'])->name('siswa.export');
        Route::post('/siswa/storeImport', [SiswaController::class, 'storeImport'])->name('siswa.storeImport');
        Route::get('/siswa/fetchall', [SiswaController::class, 'fetchAll'])->name('siswa.fetchAll');
        Route::delete('/siswa/delete', [SiswaController::class, 'delete'])->name('siswa.delete');
        Route::delete('/siswa/deleteAll', [SiswaController::class, 'deleteAll'])->name('siswa.deleteAll');
        Route::get('/siswa/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
        Route::post('/siswa/update', [SiswaController::class, 'update'])->name('siswa.update');

        Route::get('/waktu', [WaktuController::class, 'index'])->name('waktu.index');
        Route::post('/waktu/store', [WaktuController::class, 'store'])->name('waktu.store');
        Route::get('/waktu/fetchall', [WaktuController::class, 'fetchAll'])->name('waktu.fetchAll');
        Route::get('/waktu/edit', [WaktuController::class, 'edit'])->name('waktu.edit');
        Route::post('/waktu/update', [WaktuController::class, 'update'])->name('waktu.update');
        Route::delete('/waktu/delete', [WaktuController::class, 'delete'])->name('waktu.delete');
        
        Route::post('/hasil/export', [HasilController::class, 'export'])->name('hasil.export');

        Route::get('/setting', [SettingController::class, 'index'])->name('setting.index');
        Route::delete('/setting/deleteVoting', [SettingController::class, 'deleteVoting'])->name('setting.deleteVoting');
        Route::delete('/setting/deleteAll', [SettingController::class, 'deleteAll'])->name('setting.deleteAll');
    });

    Route::group(['middleware' => ['cek_login:siswa']], function () {
        // Route::get('/info_kandidat', [KandidatController::class, 'infoKandidat'])->name('kandidat.info');
        Route::get('/voting', [VotingController::class, 'index'])->name('voting.index');
        Route::post('/voting/store', [VotingController::class, 'store'])->name('voting.store');
        Route::get('/voting/info', [VotingController::class, 'info'])->name('voting.info');
    });

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/fetchuser', [ProfileController::class, 'fetchUser'])->name('profile.fetchUser');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/updatepassword', [ProfileController::class, 'updatePassword'])->name('profile.updatePassword');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

    Route::get('/qna', [ChatsController::class, 'showKandidat'])->name('qna.index');
    Route::get('/chat/{id}', [ChatsController::class, 'index'])->name('qna.detail');
    Route::get('/messages', [ChatsController::class, 'fetchMessages']);
    Route::post('/messages', [ChatsController::class, 'sendMessage']);
    Route::post('/deleteMessages', [ChatsController::class, 'deleteMessage']);
    Route::post('/deleteMessagesGroup', [ChatsController::class, 'deleteMessageGroup']);
    Route::delete('/deleteMessagesAll', [ChatsController::class, 'deleteMessageAll'])->name('messages.deleteAll');
    
    Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
    Route::post('/feedback/store', [FeedbackController::class, 'store'])->name('feedback.store');
    Route::get('/feedback/fetchAll', [FeedbackController::class, 'fetchAllFeedback'])->name('feedback.fetchAll');
    Route::delete('/feedback/delete', [FeedbackController::class, 'deleteFeedback'])->name('feedback.delete');
});
