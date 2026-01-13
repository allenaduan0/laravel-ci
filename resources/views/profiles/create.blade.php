@extends('layouts.app')

@section('title', 'Create Profile')

@section('content')
    <div class="bg-gray-800 rounded-lg shadow-lg p-6">
        <h1 class="text-2xl font-bold text-white mb-6">Create New Profile</h1>
        @include('profiles.form')
    </div>
@endsection
