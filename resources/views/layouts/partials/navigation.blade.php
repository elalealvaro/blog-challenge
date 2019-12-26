<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">Blog Challenge</a>
        <button
            class="navbar-toggler"
            type="button"
            data-toggle="collapse"
            data-target="#navbarControl"
            aria-controls="navbarControl"
            aria-expanded="false">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarControl">
            <ul class="navbar-nav mr-auto"></ul>
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a
                            class="nav-link"
                            href="{{ Auth::user()->permalink }}"
                            title="{{ Auth::user()->username }} profile">{{ Auth::user()->username }}</a>
                    </li>
                    <li>
                        <a
                            class="btn btn-primary"
                            href="{{ route('entry.create') }}" title="Create a new entry">Create an entry</a>
                    </li>
                    <li>
                        <li class="nav-item">
                            <a
                                class="nav-link"
                                href="{{ route('logout') }}"
                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
