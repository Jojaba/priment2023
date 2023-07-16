@extends('template')

@section('headtitle')
    Prim'ENT
@endsection

@section('content')
    <a href="{{ route('news') }}">
        <article>
            <header>
                <h2>Actualités</h2>
                <p>Les nouvelles fraîches de l'établissement&hellip;</p>
            </header>
        </article>
    </a>
    <a href="{{ route('homeworks') }}">
        <article>
            <header>
                <h2>Devoirs</h2>
                <p>Devoirs renseignés par les enseignant.s.es&hellip;</p>
            </header>
        </article>
    </a>
    <a href="{{ route('talks') }}">
        <article>
            <header>
                <h2>Discussions</h2>
                <p>Vos discussions&hellip;</p>
            </header>
        </article>
    </a>
    <a href="{{ route('resources') }}">
        <article>
            <header>
                <h2>Ressources</h2>
                <p>Les ressources locales ou sur le Web à disposition&hellip;</p>
            </header>
        </article>
    </a>
@endsection