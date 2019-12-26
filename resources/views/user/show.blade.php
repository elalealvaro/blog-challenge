@extends('layouts.app')

@section('title', 'User profile')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-md-8">
            <h2>User profile</h2>
            <div class="card mt-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-md-3"><strong>Username</strong></div>
                        <div class="col-12 col-md-9">
                            <p>{{ $user->username }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-3"><strong>Email</strong></div>
                        <div class="col-12 col-md-9">
                            <p>{{ $user->email }}</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-md-3"><strong>Twitter username</strong></div>
                        <div class="col-12 col-md-9">
                            <p>{{ $user->twitter_username }}</p>
                        </div>
                    </div>
                    @if (Auth::check() && Auth::id() === $user->id)
                        <a href="{{ route('user.edit', ['user' => $user]) }}">Edit profile</a>
                    @endif
                </div>
            </div>
            <hr>
            <h2>Entries</h2>
            @if ($entries->count())
                @foreach ($entries as $entry)
                    <div class="row">
                        <div class="col-12 mt-4">
                            @include('partials.entry')
                        </div>
                    </div>
                @endforeach
                <div class="row">
                    <div class="col-12 mt-4">
                        {{ $entries->links() }}
                    </div>
                </div>
            @else
                <p>The user have not written any entry yet.</p>
            @endif
        </div>
        @include('partials.twitter_sidebar')
    </div>
</div>
@endsection

@section('js')
    AppGlobals.user = '{{ $user->username }}';
    AppGlobals.userTweet = '{{ route('user.tweet', ['user' => $user]) }}';
@endsection
