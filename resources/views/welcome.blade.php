<!-- resources/views/welcome.blade.php -->

<x-guest-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Welcome to Lingo Game') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @guest
                        <p>Please <a href="{{ route('login') }}" class="underline">login</a> to start playing Lingo and see the leaderboard.</p>
                    @else
                        <p>Welcome, {{ Auth::user()->name }}!</p>
                        <p>Start playing Lingo now!</p>
                        <a href="{{ route('lingo') }}" class="bg-blue-200 hover:bg-blue-300 text-blue-800 font-bold py-2 px-4 rounded-lg text-xl">
                            Play Lingo
                        </a>

                        <div class="flex justify-center mt-4">
                            <a href="{{ route('friend') }}" class="bg-blue-200 hover:bg-blue-300 text-blue-800 font-bold py-2 px-4 rounded-lg text-xl">
                                Add a Friend
                            </a>
                        </div>

                        <div class="mt-8">
                            <h3 class="text-lg font-semibold">Leaderboard</h3>
                            <table class="mt-2 w-full">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2">Rank</th>
                                        <th class="px-4 py-2">Name</th>
                                        <th class="px-4 py-2">Guesses</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($leaderboard as $key => $score)
                                        <tr>
                                            <td class="border px-4 py-2">{{ $key + 1 }}</td>
                                            <td class="border px-4 py-2">{{ $score->user->name }}</td>
                                            <td class="border px-4 py-2">{{ $score->guesses }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pending Friend Requests -->
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 bg-white border-b border-gray-200">
                                    <h3 class="text-lg font-semibold">Pending Friend Requests</h3>
                                    @foreach (Auth::user()->receivedFriendRequests()->where('status', 'pending')->get() as $friendRequest)
                                        <div class="flex justify-between items-center mt-4">
                                            <div>{{ $friendRequest->sender->name }} ({{ $friendRequest->sender->email }})</div>
                                            <div>
                                                <form method="POST" action="{{ route('friend.accept', $friendRequest->id) }}">
                                                    @csrf
                                                    <button type="submit" class="bg-green-500 hover:bg-green-700 text-black font-bold py-2 px-4 rounded">
                                                        Accept
                                                    </button>
                                                </form>
                                                <form method="POST" action="{{ route('friend.reject', $friendRequest->id) }}">
                                                    @csrf
                                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-black font-bold py-2 px-4 rounded">
                                                        Reject
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        <!-- Friends List -->
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
                            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                                <div class="p-6 bg-white border-b border-gray-200">
                                    <h3 class="text-lg font-semibold">Friends</h3>
                                    @foreach (Auth::user()->friends as $friend)
                                        <div class="flex justify-between items-center mt-4">
                                            <div>{{ $friend->name }} ({{ $friend->email }})</div>
                                            <div>{{ $friend->last_status }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
