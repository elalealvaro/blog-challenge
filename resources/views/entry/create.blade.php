@extends('layouts.app')

@section('title', 'Create an entry')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>Create an entry</h2>
            <div class="card mt-4">
                <div class="card-body">
                    <form method="POST" action="{{ route('entry.save') }}">
                        @csrf
                        @include('entry.form')
                        <input type="hidden" name="user_id" value="{{ Auth::id() }}">
                        <div class="form-group row">
                            <div class="col-12 col-md-10 offset-md-2">
                                <button type="submit" class="btn btn-primary">Create</button>
                                <a href="/" class="btn btn-secondary">Cancel</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
