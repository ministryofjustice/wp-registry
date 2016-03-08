@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Plugins</div>

                    <div class="panel-body">
                        <a href="{{ route('plugins.index') }}">Return to list</a>

                        <h1>{{ $plugin->name }}</h1>

                        <dl class="dl-horizontal">
                            <dt>Current Version</dt>
                            <dd>{{ $plugin->current_version }}</dd>
                        </dl>

                        <h2>Installs <small>({{count($plugin->installs)}})</small></h2>

                        @if (count($plugin->installs))
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>URL</th>
                                        <th>Active</th>
                                        <th>Version</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($plugin->installs as $install)
                                        <tr class="{{ ($install->pivot->version !== $plugin->current_version)? 'danger' : '' }}">
                                            <td><a href="{{ route('installs.view', [$install->id]) }}">{{ $install->name }}</a></td>
                                            <td><a href="{{ $install->url }}" target="_blank">{{ $install->url }} <span class="fa fa-external-link"></span></a></td>
                                            <td>
                                                @if($install->pivot->is_active)
                                                    <span class="label label-primary">active</span>
                                                @else
                                                    <span class="label label-default">inactive</span>
                                                @endif
                                            </td>
                                            <td>{{ $install->pivot->version }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>There are no installations of this plugin.</p>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

@stop