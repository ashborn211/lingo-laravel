<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Score;

class WelcomeController extends Controller
{
    public function index()
    {
        $leaderboard = Score::with('user')->orderBy('guesses', 'asc')->take(10)->get();
        return view('welcome', compact('leaderboard'));
    }
}
