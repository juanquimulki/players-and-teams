@extends('layouts.master')
@section('title', 'Available Players')

@section('content')
    <div id="app">
        <h1>Players</h1>

        <players-table :items={{ $players }}></players-table>
    </div>
@stop
