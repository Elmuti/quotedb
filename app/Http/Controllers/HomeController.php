<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Container\Attributes\CurrentUser;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    public function index(Request $request, #[CurrentUser] ?User $user)
    {
        $canView = $user && $user->isAdmin();

        return Inertia::render('Home', [
            'canView' => $canView,
            'auth' => [
                'user' => $user,
            ],
        ]);
    }
}
