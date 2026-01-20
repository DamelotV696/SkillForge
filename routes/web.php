<?php
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use App\Models\ExchangeTypes;
use App\Models\level;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Foundation\Application;
use App\Models\Skill;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
 | Public welcome
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
        'categories' => Category::paginate(6),

    ]);
});

/*
 | Dashboard
*/
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia('Dashboard');
    })->name('dashboard');
});
/*
 | Authenticated routes
*/
// Route::middleware('auth')->group(function () {
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/admin/users', function () {
        return Inertia::render('Admin/Users', [
            'users' => User::all()
        ]);
    });
    Route::get('/admin/categories', function () {
        return Inertia::render('Admin/Categories', [
            'categories' => Category::all()
        ]);
    });
    // Route::get('/profile', function () {
    //     return Inertia::render('Profile', [
    //         'user' => Auth::user()
    //     ]);
    // })->name('profile');
    Route::get('/skills/create', function () {
        return Inertia::render('Skill/CreateSkill', [
            'categories' => Category::all(),
            'exchangeTypes' => ExchangeTypes::all(),
            'level' => level::all()

        ]);
    })->name('skills.create');

    Route::post('/skills', function (Request $request) {
        $validated = $request->validate([
            'image' => 'nullable|file|image|max:2048',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'level_id' => 'required|exists:levels,id',
            'place_execution' => 'required|string',
            'exchange_type_id' => 'required|exists:exchange_types,id',
            'price' => 'nullable|numeric|min:0',
        ]);

        $validated['user_id'] = Auth::id();

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('skills', 'public');
            $validated['image'] = $path;
        }

        $skill = Skill::create($validated);

        return response()->json([
            'message' => 'Skill created successfully',
            'skill' => $skill
        ], 201);
    })->name('skills.store');



    // Route::middleware('auth')->get('/api/profile', function () {
    //     return response()->json([
    //         'profile' => auth()->user(),
    //     ]);
    // });
});

require __DIR__ . '/auth.php';
