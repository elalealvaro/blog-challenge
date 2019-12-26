<article class="card entry-card">
    <div class="card-header"><h2>{{ $entry->title }}</h2></div>
    <div class="card-body">{{ $entry->content }}</div>
    <div class="card-footer">
        Posted at {{ $entry->created }}
        by <a href="{{ $entry->user->permalink }}" title="{{ $entry->user->username }} profile">{{ $entry->user->username }}</a>
        @if (Auth::check() && Auth::id() === $entry->user->id)
            <a href="{{ route('entry.edit', ['entry' => $entry]) }}" class="btn btn-link btn-sm float-right">Edit</a>
        @endif
    </div>
</article>
