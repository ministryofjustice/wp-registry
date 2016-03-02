@extends('app')

@section('content')

    <a href="/">Return to list</a>

    <h1>{{ $install->name }}</h1>

    <dl class="dl-horizontal">
        <dt>Install Name</dt>
        <dd>{{ $install->name }}</dd>
        <dt>URL</dt>
        <dd><a href="{{ $install->url }}" target="_blank">{{ $install->url }}</a></dd>
        <dt>Environment</dt>
        <dd>{{ $install->environment }}</dd>
        <dt>WordPress Version</dt>
        <dd>{{ $install->wordpress_version }}</dd>
    </dl>

@stop