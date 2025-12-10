<?php

use App\Http\Controllers\CollectionController;
use App\Livewire\Settings\Profile;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Appearance;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TagController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Livewire\Home;
use App\Livewire\Posts\AllPosts;
use App\Livewire\Posts\ShowPost;
use App\Livewire\Search;
use App\Livewire\Tags\AllTags;

Route::get('/', Home::class)->name('home');

Route::get('/posts', AllPosts::class)->name('posts.index');

Route::get('/posts/{post}', ShowPost::class)->name('posts.show');

Route::get('/tags', AllTags::class)->name('tags.index');

Route::get('/tags/{tag}', [TagController::class, 'show'])->name('tags.show');

// Route::get('/search', [TagController::class, 'search'])->name('tags.search');
Route::get('/search', Search::class)->name('search');

Route::get('/collections/{collection}', [CollectionController::class, 'show'])->name('collections.show');

Route::get('/@{user}', [UserController::class, 'show'])->name('users.show');

Route::view('/about', 'about')->name('about');
Route::view('/contact', 'contact')->name('contact');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__ . '/auth.php';
