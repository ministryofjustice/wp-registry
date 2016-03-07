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
                            <dt>WordPress Version</dt>
                            <dd>{{ $install->wordpress_version }}</dd>
                        </dl>

                        <h2>Installed Plugins <small>({{count($install->plugins)}})</small></h2>

                        @if (count($install->plugins))
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Plugin</th>
                                        <th>Version</th>
                                        <th>Is mu-plugin?</th>
                                        <th>Is active?</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($install->plugins as $plugin)
                                        <tr class="{{ (!$plugin->pivot->is_active)? 'active' : '' }}">
                                            <td>{{ $plugin->name }}</td>
                                            <td>{{ $plugin->pivot->version }}</td>
                                            <td>{{ $plugin->pivot->is_mu_plugin }}</td>
                                            <td>{{ $plugin->pivot->is_active }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>No plugins installed.</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

@stop