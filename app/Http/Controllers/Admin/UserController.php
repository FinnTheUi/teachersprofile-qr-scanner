<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function toggleStatus(User $user)
    {
        $user->is_active = !$user->is_active;
        $user->save();

        return back()->with('success', 
            $user->is_active ? 'User account has been activated.' : 'User account has been suspended.'
        );
    }
}