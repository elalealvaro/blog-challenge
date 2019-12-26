@extends('layouts.app')

@section('title', 'Edit profile')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>User profile</h2>
            <div class="card mt-4">
                <div class="card-body">
                    <form method="POST" action="{{ route('user.update', ['user' => $user]) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="form-group row">
                            <label for="username" class="col-12 col-md-2 col-form-label">Username</label>
                            <div class="col-12 col-md-10">
                                <input
                                    type="text"
                                    class="form-control"
                                    id="username"
                                    name="username"
                                    placeholder="Username"
                                    value="{{ old('username', $user->username) }}">
                                @if ($errors->has('username'))
                                    <span class="text-danger">{{ $errors->first('username') }}</span>
                                @endif
                                <small class="text-muted">Change the username will generate an update on the permalink for user's profile.</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-12 col-md-2 col-form-label">Email</label>
                            <div class="col-12 col-md-10">
                                <input
                                    type="email"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    placeholder="email"
                                    value="{{ old('email', $user->email) }}"
                                    disabled>
                                <small class="text-muted">Email address can not be changed.</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="twitter" class="col-12 col-md-2 col-form-label">Twitter username</label>
                            <div class="col-12 col-md-10">
                                <input
                                    type="twitter_username"
                                    class="form-control"
                                    id="twitter_username"
                                    name="twitter_username"
                                    placeholder="Twitter account"
                                    value="{{ old('twitter_username', $user->twitter_username) }}">
                                @if ($errors->has('twitter_username'))
                                    <span class="text-danger">{{ $errors->first('twitter_username') }}</span>
                                @endif
                                <small class="text-muted">Insert only your username, without Twitter's url (https://twitter.com/)</small>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12 col-md-10 offset-md-2">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ $user->permalink }}" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
