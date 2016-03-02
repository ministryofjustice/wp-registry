@extends('app')

@section('content')

    <h1>Installs</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>URL</th>
                <th>Environment</th>
                <th>WordPress version</th>
            </tr>
        </thead>

        @foreach ($installs as $install)
            <tr>
                <td><a href="{{ action('InstallsController@view', [$install->id]) }}">{{ $install->name }}</a></td>
                <td><a href="{{ $install->url }}" target="_blank" >{{ $install->url }}</a></td>
                <td>{{ $install->environment }}</td>
                <td>{{ $install->wordpress_version }}</td>
            </tr>
        @endforeach

    </table>

@stop