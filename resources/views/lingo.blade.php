<!-- resources/views/lingo.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Lingo Game</title>
    <style>
        .correct {
            background-color: green;
            color: white;
        }
        .present {
            background-color: yellow;
            color: black;
        }
        .absent {
            background-color: red;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Lingo Game</h1>
    
    <form action="/guess" method="POST">
        @csrf
        <label for="word">Enter your guess:</label>
        <input type="text" id="word" name="word" maxlength="5" required>
        <button type="submit">Submit</button>
    </form>

    @if (isset($guesses) && count($guesses) > 0)
        <h2>Guesses:</h2>
        <table border="1">
            <tr>
                <th>Guess</th>
                <th>Result</th>
            </tr>
            @foreach ($guesses as $guess)
                <tr>
                    <td>{{ strtoupper($guess['word']) }}</td>
                    <td>
                        @foreach ($guess['result'] as $index => $status)
                            <span class="{{ $status }}">{{ strtoupper($guess['word'][$index]) }}</span>
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </table>
    @endif

    <form action="/reset" method="POST">
        @csrf
        <button type="submit">Reset Game</button>
    </form>

    <br>

    <a href="/add-word"><button>Add New Word</button></a>
</body>
</html>
