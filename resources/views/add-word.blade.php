<!-- resources/views/add-word.blade.php -->

<!DOCTYPE html>
<html>
<head>
    <title>Add Word</title>
</head>
<body>
    <h1>Add a New Word</h1>

    @if (session('success'))
        <p>{{ session('success') }}</p>
    @endif

    <form action="/add-word" method="POST">
        @csrf
        <label for="word">Enter a 5-letter word:</label>
        <input type="text" id="word" name="word" maxlength="5" required>
        <button type="submit">Add Word</button>
    </form>

    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <br>

    <a href="/"><button>Back to Game</button></a>
</body>
</html>
