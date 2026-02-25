<?php

use App\Http\Controllers\Admin\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Admin\Auth\NewPasswordController;
use App\Http\Controllers\Admin\Auth\PasswordResetLinkController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ItemReviewController;
use App\Http\Controllers\Admin\KycController;
use App\Http\Controllers\Admin\KYCSettingController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\RoleUserController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\SubCategoryController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:admin')
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

        Route::get('login', [AuthenticatedSessionController::class, 'create'])
            ->name('login');

        Route::post('login', [AuthenticatedSessionController::class, 'store']);

        Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
            ->name('password.request');

        Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
            ->name('password.email');

        Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
            ->name('password.reset');

        Route::post('reset-password', [NewPasswordController::class, 'store'])
            ->name('password.store');
    });

Route::middleware('auth:admin')->prefix('admin')->as('admin.')->group(function () {

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /** Profile Routes */
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('password', [ProfileController::class, 'updatePassword'])->name('password.update');

    /** Role Management Routes */
    Route::resource('roles', RoleController::class);

    /** Role User Routes */
    Route::resource('role-users', RoleUserController::class);

    /** KYC Routes */
    Route::get('kyc-settings', [KYCSettingController::class, 'index'])->name('kyc-settings.index');
    Route::put('kyc-settings', [KYCSettingController::class, 'update'])->name('kyc-settings.update');
    Route::get('kyc-download-document/{kyc}/{attachment_id}', [KycController::class, 'downloadDocument'])->name('kyc.download-document');
    Route::put('kyc-status/{kyc}', [KycController::class, 'updateStatus'])->name('kyc.status');
    Route::resource('kyc', KycController::class);

    /** Categories Routes */
    Route::resource('categories', CategoryController::class);

    /** Sub Categories Routes */
    Route::resource('sub-categories', SubCategoryController::class);

    /** item review routes */
    Route::get('item-reviews/pending', [ItemReviewController::class, 'pendingIndex'])->name('item-reviews.pending.index');
    Route::get('item-reviews/approve', [ItemReviewController::class, 'approveIndex'])->name('item-reviews.approved.index');
    Route::get('item-reviews/hard-rejected', [ItemReviewController::class, 'hardRejectedIndex'])->name('item-reviews.hardrejected.index');
    Route::get('item-reviews/soft-rejected', [ItemReviewController::class, 'softRejectedIndex'])->name('item-reviews.softrejected.index');
    Route::get('item-reviews/resubmitted', [ItemReviewController::class, 'resubmittedIndex'])->name('item-reviews.resubmitted.index');
    Route::get('item-reviews/{id}/show', [ItemReviewController::class, 'show'])->name('item-reviews.show');
    Route::post('item-reviews/{id}/status', [ItemReviewController::class, 'updateStatus'])->name('item-reviews.status');
    Route::get('item/{id}/download', [ItemReviewController::class, 'itemDownload'])->name('item.download');

    /** Settings Route */
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('general-settings', [SettingController::class, 'updateGeneralSetting'])->name('settings.general.update');
    Route::get('commission-settings', [SettingController::class, 'commissionSetting'])->name('settings.commission.index');
    Route::put('commission-settings', [SettingController::class, 'updateCommissionSetting'])->name('settings.commission.update');

    Route::get('logo-settings', [SettingController::class, 'logoSetting'])->name('settings.logo.index');
    Route::put('logo-settings', [SettingController::class, 'updateLogoSetting'])->name('settings.logo.update');

    Route::get('smtp-settings', [SettingController::class, 'smtpSetting'])->name('settings.smtp.index');
    Route::put('smtp-settings', [SettingController::class, 'updateSmtpSetting'])->name('settings.smtp.update');
});
