@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Installs</div>

                    <div class="panel-body">
                        <a href="{{ action('InstallsController@index') }}">Return to list</a>

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
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop