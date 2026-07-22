<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeaderController;
use App\Http\Controllers\Admin\HeroController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ServicesController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\SectionsController;
use App\Http\Controllers\Admin\CultureController;
use App\Http\Controllers\Admin\JoinController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\ContactFooterController;
use App\Http\Controllers\Admin\FooterController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\SystemConfigurationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/team', function () {
    return view('team');
});

Route::get('/portfolio', function () {
    return view('portfolio');
});

Route::get('/our-service', function () {
    return view('culture');
});

Route::get('/contact', function () {
    return view('contact');
});

Route::post('/contact', [ContactController::class, 'submit'])->name('contact.submit');

// Admin Routes
Route::prefix('admin')->group(function () {
    // Guest Routes
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // Authenticated Routes
    Route::middleware('admin.auth')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');

        Route::get('/header', [HeaderController::class, 'index'])->name('admin.header');
        Route::post('/header/logo', [HeaderController::class, 'saveLogo'])->name('admin.header.logo');
        Route::post('/header/links', [HeaderController::class, 'saveLinks'])->name('admin.header.links');

        Route::get('/hero', [HeroController::class, 'index'])->name('admin.hero');
        Route::post('/hero', [HeroController::class, 'save'])->name('admin.hero.save');

        Route::get('/about', [AboutController::class, 'index'])->name('admin.about');
        Route::post('/about', [AboutController::class, 'save'])->name('admin.about.save');

        Route::get('/about-page', [\App\Http\Controllers\Admin\AboutPageController::class, 'index'])->name('admin.about-page');
        Route::post('/about-page', [\App\Http\Controllers\Admin\AboutPageController::class, 'save'])->name('admin.about-page.save');

        Route::get('/services', [ServicesController::class, 'index'])->name('admin.services');
        Route::post('/services', [ServicesController::class, 'saveSection'])->name('admin.services.save');
        Route::post('/services/list', [ServicesController::class, 'saveList'])->name('admin.services.list.save');

        // Projects CRUD
        Route::post('/projects/settings', [ProjectController::class, 'saveSettings'])->name('admin.projects.settings');
        Route::get('/projects', [ProjectController::class, 'index'])->name('admin.projects.index');
        Route::get('/projects/create', [ProjectController::class, 'create'])->name('admin.projects.create');
        Route::post('/projects', [ProjectController::class, 'store'])->name('admin.projects.store');
        Route::get('/projects/{id}/edit', [ProjectController::class, 'edit'])->name('admin.projects.edit');
        Route::put('/projects/{id}', [ProjectController::class, 'update'])->name('admin.projects.update');
        Route::delete('/projects/{id}', [ProjectController::class, 'destroy'])->name('admin.projects.destroy');

        // Inquiries CRM
        Route::get('/inquiries', [InquiryController::class, 'index'])->name('admin.inquiries.index');
        Route::put('/inquiries/{id}', [InquiryController::class, 'update'])->name('admin.inquiries.update');
        Route::delete('/inquiries/{id}', [InquiryController::class, 'destroy'])->name('admin.inquiries.destroy');

        // Work Culture Settings
        Route::get('/culture', [CultureController::class, 'index'])->name('admin.culture');
        Route::post('/culture', [CultureController::class, 'save'])->name('admin.culture.save');

        // Why Join Us Settings
        Route::get('/join', [JoinController::class, 'index'])->name('admin.join');
        Route::post('/join', [JoinController::class, 'save'])->name('admin.join.save');

        // Moments Gallery Settings
        Route::get('/gallery', [GalleryController::class, 'index'])->name('admin.gallery');
        Route::post('/gallery', [GalleryController::class, 'save'])->name('admin.gallery.save');
        Route::post('/gallery/delete', [GalleryController::class, 'deleteImage'])->name('admin.gallery.delete');

        // Contact Section Settings
        Route::get('/contact-settings', [ContactFooterController::class, 'index'])->name('admin.contact-footer');
        Route::post('/contact-settings', [ContactFooterController::class, 'save'])->name('admin.contact-footer.save');

        // Website Footer Settings
        Route::get('/footer', [FooterController::class, 'index'])->name('admin.footer');
        Route::post('/footer', [FooterController::class, 'save'])->name('admin.footer.save');

        // Meet Our Team Settings
        Route::get('/team', [TeamController::class, 'index'])->name('admin.team');
        Route::post('/team', [TeamController::class, 'save'])->name('admin.team.save');

        // Sections Configuration
        Route::get('/sections', [SectionsController::class, 'index'])->name('admin.sections');
        Route::post('/sections/culture', [SectionsController::class, 'saveCulture'])->name('admin.sections.culture');
        Route::post('/sections/join', [SectionsController::class, 'saveJoin'])->name('admin.sections.join');
        Route::post('/sections/gallery', [SectionsController::class, 'saveGallery'])->name('admin.sections.gallery');
        Route::post('/sections/gallery/delete', [SectionsController::class, 'deleteGalleryImage'])->name('admin.sections.gallery.delete');
        Route::post('/sections/contact-footer', [SectionsController::class, 'saveContactFooter'])->name('admin.sections.contact-footer');

        // System Configuration
        Route::get('/system-config', [SystemConfigurationController::class, 'index'])->name('admin.system-config');
        Route::post('/system-config', [SystemConfigurationController::class, 'save'])->name('admin.system-config.save');
    });
});

