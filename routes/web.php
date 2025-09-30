<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

$posts = collect([
    [
        'id' => 1,
        'slug' => 'slug-1',
        'title' => 'Boost your conversion rate',
        'content' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quaerat ratione fugiat possimus inventore pariatur aut, alias quasi asperiores minima omnis!...',
        'banner' => config('app.banner')[0],
        'photos' => config('app.photos')[0],
        'tag' => 'Marketing',
        'author' => [
            'name' => 'Fikri Setiawan',
            'role' => 'Web Developer',
            'avatar' => config('app.photos')[0],
        ],
    ],
    [
        'id' => 2,
        'slug' => 'slug-2',
        'title' => 'How to use search engine optimization to drive sales',
        'content' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quaerat ratione fugiat possimus omnis!...',
        'banner' => config('app.banner')[1],
        'photos' => config('app.photos')[1],
        'tag' => 'Sales',
        'author' => [
            'name' => 'Fikri Setiawan',
            'role' => 'Web Developer',
            'avatar' => config('app.photos')[1],
        ],
    ],
    [
        'id' => 3,
        'slug' => 'slug-3',
        'title' => 'Improve your customer experience',
        'content' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Quaerat ratione fugiat possimus inventore pariatur aut, alias quasi asperiores minima omnis!...',
        'banner' => config('app.banner')[2],
        'photos' => config('app.photos')[2],
        'tag' => 'Business',
        'author' => [
            'name' => 'Fikri Setiawan',
            'role' => 'Web Developer',
            'avatar' => config('app.photos')[2],
        ],
    ],
]);

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/posts', function () use ($posts) {
    return view('posts.index', compact('posts'));
})->name('posts.index');

Route::get('/posts/{slug}', function () use ($posts) {
    $post = collect($posts->firstWhere('slug', request()->slug));
    return view('posts.show', compact('post'));
})->name('posts.show');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

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
