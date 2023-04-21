<section>
    <h1>{{ $title }}</h1>

    <nav>
        <ul>
            <li><a href="/">Projects</a></li>
            <li><a href="/Admin">Admin</a></li>
            <li>
                <form action="{{ route('logout') }}" method="post">
                @csrf
                <button type="submit">Logout</button>
                </form>
            </li>
        </ul>
    </nav>
</section>