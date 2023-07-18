@extends('layouts.master')
@section('title', 'Available Players')

@section('content')
    <h1>Available Players</h1>

    <players-table :items="{{ $players }}"></players-table>
@stop
