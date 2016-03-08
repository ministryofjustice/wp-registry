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
                                <th colspan="2">WordPress version</th>
                            </tr>
                            </thead>

                            @foreach ($installs as $install)
                                <tr>
                                    <td><a href="{{ route('installs.view', [$install->id]) }}">{{ $install->name }}</a></td>
                                    <td><a href="{{ $install->url }}" target="_blank" >{{ $install->url }} <i class="fa fa-external-link"></i></a></td>
                                    <td>{{ $install->wordpress_version }}</td>
                                    <td>
                                        @if(!$install->wordpress_is_current)
                                            <span class="label label-danger" title="Current version is {{ $wordpressCurrentVersion }}">
                                                out of date
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop