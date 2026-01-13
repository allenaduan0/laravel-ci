@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
    <div class="bg-gray-800 rounded-lg shadow-lg p-6">
        <h1 class="text-2xl font-bold text-white mb-6">Edit Profile: {{ $profile->username }}</h1>
        @include('profiles.form')
    </div>
@endsection
