@extends('layouts.app')

@section('title', 'Edit an entry')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h2>Edit an entry</h2>
            <div class="card mt-4">
                <div class="card-body">
                    <form method="POST" action="{{ route('entry.update', ['entry' => $entry]) }}">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="entry_id" value="{{ $entry->id }}">
                        @include('entry.form')
                        <div class="form-group row">
                            <div class="col-12 col-md-10 offset-md-2">
                                <button type="submit" class="btn btn-primary">Update</button>
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
