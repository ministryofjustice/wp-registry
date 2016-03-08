@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Installs</div>

                    <div class="panel-body">
                        <a href="{{ route('installs.index') }}">Return to list</a>

                        <h1>{{ $install->name }}</h1>

                        <dl class="dl-horizontal">
                            <dt>Install Name</dt>
                            <dd>{{ $install->name }}</dd>
                            <dt>URL</dt>
                            <dd><a href="{{ $install->url }}" target="_blank">{{ $install->url }} <i class="fa fa-external-link"></i></a></dd>
                            <dt>WordPress Version</dt>
                            <dd>{{ $install->wordpress_version }}</dd>
                        </dl>

                        <h2>Installed Plugins <small>({{count($install->plugins)}})</small></h2>

                        @if (count($install->plugins))
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Plugin</th>
                                        <th>Active</th>
                                        <th>Type</th>
                                        <th colspan="2">Version</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($install->plugins as $plugin)
                                        <tr>
                                            <td>
                                                <a href="{{ route('plugins.view', [$plugin->id]) }}">
                                                    {{ $plugin->name }}
                                                </a>
                                            </td>
                                            <td>
                                                @if($plugin->pivot->is_active)
                                                    <span class="label label-primary">active</span>
                                                @else
                                                    <span class="label label-default">inactive</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($plugin->pivot->is_mu_plugin)
                                                    mu-plugin
                                                @else
                                                    plugin
                                                @endif
                                            </td>
                                            <td>
                                                {{ $plugin->pivot->version }}
                                            </td>
                                            <td>
                                                @if(!$plugin->pivot->is_current)
                                                    <span class="label label-danger" title="Current version is {{ $plugin->current_version }}">
                                                        out of date
                                                    </span>
                                                @endif
                                            </td>
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