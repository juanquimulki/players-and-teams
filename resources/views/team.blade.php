@extends('layouts.master')
@section('title', 'Generated Teams')

@section('content')
    <h1 style="margin-bottom: 20px;">Generated Teams</h1>

    <teams-page :items="{{ json_encode($teams) }}"></teams-page>
@stop
