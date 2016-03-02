@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Installs</div>

                    <div class="panel-body">
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
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop