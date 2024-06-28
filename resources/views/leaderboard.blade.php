<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leaderboard</title>
</head>
<body>
    <h1>Leaderboard</h1>
    <table>
        <thead>
            <tr>
                <th>Rank</th>
                <th>Name</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
            @foreach($leaderboard as $key => $score)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $score->name }}</td>
                <td>{{ $score->score }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
