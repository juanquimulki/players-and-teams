@extends('layouts.master')
@section('title', 'Generated Teams')

@section('content')
    <h1>Generated Teams</h1>

    <team-table :items="{{ $players }}"></team-table>
@stop
