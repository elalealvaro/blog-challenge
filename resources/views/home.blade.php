@extends('layouts.app')

@section('title', 'Latest entries')

@section('content')
<div class="container">
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
        <div class="row">
            <div class="col-12">
                <p>There's no entries yet.</p>
            </div>
        </div>
    @endif
</div>
@endsection
