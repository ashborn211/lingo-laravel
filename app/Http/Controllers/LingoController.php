<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Word;
use App\Models\Score;
use Illuminate\Support\Facades\Auth;

class LingoController extends Controller
{
    public function index()
    {
        if (!session()->has('guesses')) {
            session()->put('guesses', []);
            session()->put('correctWord', Word::getRandomWord());
        }

        return view('lingo', [
            'guesses' => session('guesses'), 
            'correctWord' => session('correctWord')
        ]);
    }

    public function guess(Request $request)
    {
        $request->validate([
            'word' => 'required|string|size:5'
        ]);

        $inputWord = strtolower($request->word);
        $correctWord = session('correctWord');
        $result = $this->compareWords($inputWord, $correctWord);

        $guesses = session('guesses');
        $guesses[] = ['word' => $inputWord, 'result' => $result];
        session()->put('guesses', $guesses);

        if ($inputWord === $correctWord) {
            $this->storeScore(count($guesses));

            session()->forget('guesses');
            session()->forget('correctWord');
        }

        return view('lingo', [
            'guesses' => $guesses, 
            'correctWord' => $correctWord
        ]);
    }

    private function compareWords($inputWord, $correctWord)
    {
        $result = [];

        for ($i = 0; $i < strlen($inputWord); $i++) {
            if ($inputWord[$i] === $correctWord[$i]) {
                $result[$i] = 'correct';
            } elseif (strpos($correctWord, $inputWord[$i]) !== false) {
                $result[$i] = 'present';
            } else {
                $result[$i] = 'absent';
            }
        }

        return $result;
    }

    private function storeScore($guessesCount)
    {
        Score::create([
            'user_id' => Auth::id(),
            'guesses' => $guessesCount,
        ]);
    }

    public function showAddWordForm()
    {
        return view('add-word');
    }

    public function addWord(Request $request)
    {
        $request->validate([
            'word' => 'required|string|size:5|unique:words,word'
        ]);

        Word::create([
            'word' => strtolower($request->word)
        ]);

        return redirect('/add-word')->with('success', 'Word added successfully!');
    }

    public function reset()
    {
        session()->forget('guesses');
        session()->forget('correctWord');
        session()->put('correctWord', Word::getRandomWord());

        return redirect('/');
    }

    public function leaderboard()
    {
        $leaderboard = Score::with('user')->orderBy('guesses', 'asc')->take(10)->get();
        return view('leaderboard', compact('leaderboard'));
    }
}
