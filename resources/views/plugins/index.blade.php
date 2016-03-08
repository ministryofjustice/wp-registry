@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Plugins</div>

                    <div class="panel-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Current Version</th>
                                <th>Number of Installs</th>
                            </tr>
                            </thead>

                            @foreach ($plugins as $plugin)
                                <tr>
                                    <td><a href="{{ route('plugins.view', [$plugin->id]) }}">{{ $plugin->name }}</a></td>
                                    <td>{{ $plugin->current_version }}</td>
                                    <td>{{ $plugin->installs()->count() }}</td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop