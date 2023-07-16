<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('headtitle')</title>
    </head>
    <body>
        <div class="top-header">
            <header class="main-header">
                <h1><a href="{{ route('home') }}">Prim'<span>ENT</span></a></h1>
            </header>
            <nav>
                <ul>
                    <li><a href="{{ route('news') }}">Actualités</a></li>
                    <li><a href="{{ route('homeworks') }}">Devoirs</a></li>
                    <li><a href="{{ route('talks') }}">Discussions</a></li>
                    <li><a href="{{ route('resources') }}">Ressources</a></li>
                </ul>
            </nav>
        </div>
        <main>
            @yield('content')
        </main>
        <footer class="mai-footer">
            Ici le footer, copyright, mentions légales, RGPD,&hellip;
        </footer>
    </body>
</html>
