<aside class="col-12 col-md-4 twitter-sidebar">
    <h2>Twitter</h2>
    @if (count($tweets) > 0)
        @foreach ($tweets as $tweet)
            <div class="card my-4">
                <div class="card-body">
                    <p>{{ $tweet['text'] }}</p>
                    @if (Auth::check() && Auth::id() === $user->id)
                        @if (isset($tweet['hidden']))
                            <a
                                href=""
                                class="float-right"
                                data-tweet-id="{{ $tweet['id_str'] }}"
                                data-tweet-action="show">Show this tweet</a>
                        @else
                            <a
                                href=""
                                class="float-right"
                                data-tweet-id="{{ $tweet['id_str'] }}"
                                data-tweet-action="hide">Hide this tweet</a>
                        @endif
                    @endif
                </div>
            </div>
        @endforeach
    @else
        <div class="twitter-empty text-center">
            <span>No tweets to show.</span>
        </div>
    @endif
</aside>
