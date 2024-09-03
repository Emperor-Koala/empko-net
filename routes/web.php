<?php

use App\Http\Controllers\ResumeController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SoftwareController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\DevlogController;
use App\Http\Controllers\DevlogPostController;
use App\Http\Controllers\DevlogSeriesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', fn() => view("home"))->name("home");
Route::get('/resume', [ResumeController::class, 'index'])->name("resume");
Route::get('/projects', [ProjectController::class, 'index'])->name("projects");
Route::get('/projects/{project}', [ProjectController::class, 'show'])->name("project");

Route::get('/devlog', [DevlogController::class, 'index'])->name("devlog");
Route::get('/devlog/search', [DevlogController::class, 'search'])->name("devlog.search");
Route::get('/devlog/post/{post}', [DevlogPostController::class, 'show'])->name("devlog.post");
Route::get('/devlog/series/{series}', [DevlogSeriesController::class, 'show'])->name("devlog.series");

Route::get('/sierrassymphony', fn() => view("sierrassymphony.about"))->name("sierrassymphony");
Route::get('/sierrassymphony/delete', fn() => view("sierrassymphony.delete-account"))->name("sierrassymphony.delete");

// Route::get("/home", fn() => view("home"))->name("home");


// Route::get("/admin", fn () => redirect("/admin/dashboard"));
// Route::get('/admin/dashboard', fn () => view('dashboard'))
//         ->middleware(['auth', 'verified'])
//         ->name('dashboard');

Route::middleware('auth')->group(function () {
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::post("/languages", [LanguageController::class, 'store'])->name("languages.store");
    Route::delete("/languages/{language}", [LanguageController::class, 'destroy'])->name("languages.delete");

    Route::post("/software", [SoftwareController::class, 'store'])->name("software.store");
    Route::delete("/software/{software}", [SoftwareController::class, 'destroy'])->name("software.delete");

    Route::post("/experience", [ExperienceController::class, 'store'])->name("experience.store");
    Route::patch("/experience/{experience}", [ExperienceController::class, 'update'])->name("experience.update");
    Route::delete("/experience/{experience}", [ExperienceController::class, 'destroy'])->name("experience.delete");

    Route::post("/schools", [SchoolController::class, 'store'])->name("schools.store");
    Route::patch("/schools/{school}", [SchoolController::class, 'update'])->name("schools.update");
    Route::delete("/schools/{school}", [SchoolController::class, 'destroy'])->name("schools.delete");

    Route::prefix("/admin")->group(function () {
        Route::get("/", fn () => redirect("/admin/resume"));
        Route::get("/resume", [ResumeController::class, 'edit'])->name("admin.resume");
        Route::get("/projects", [ProjectController::class, 'list'])->name("admin.projects");
        Route::get("/projects/create", [ProjectController::class, 'create'])->name("admin.projects.create");

        Route::post("/projects", [ProjectController::class, 'store'])->name("admin.projects.store");
        Route::get("/projects/{project}/edit", [ProjectController::class, 'edit'])->name("admin.projects.edit");
        Route::patch("/projects/{project}", [ProjectController::class, 'update'])->name("admin.projects.update");
        Route::delete("/projects/{project}", [ProjectController::class, 'destroy'])->name("admin.projects.delete");
        // Route::get("/images", fn () => view("admin.images"))->name("admin.images");

        Route::post("/files", [FileController::class, 'store'])->name("admin.upload-file");
        Route::delete("/files/{file}", [FileController::class, 'destroy'])->name("admin.delete-file");
    });
});

require __DIR__.'/auth.php';
