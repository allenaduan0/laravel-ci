@extends('layouts.app')

@section('title', $profile->username)

@section('content')
    <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        @if ($profile->cover_photo_path)
            <div class="h-48 w-full overflow-hidden">
                <img src="{{ Storage::url($profile->cover_photo_path) }}" alt="Cover Photo" class="w-full h-full object-cover">
            </div>
        @endif

        <div class="p-6">
            <div class="flex items-center gap-4 mb-6">
                @if ($profile->photo_path)
                    <img src="{{ Storage::url($profile->photo_path) }}" alt="{{ $profile->username }}"
                        class="size-20 rounded-full border-2 border-gray-700">
                @else
                    <div class="size-20 rounded-full bg-gray-700 flex items-center justify-center">
                        <i class="fas fa-user text-gray-400 text-2xl"></i>
                    </div>
                @endif
                <div>
                    <h1 class="text-2xl font-bold text-white">{{ $profile->first_name }} {{ $profile->last_name }}</h1>
                    <p class="text-gray-400">@ {{ $profile->username }}</p>
                    <p class="text-gray-400">{{ $profile->email }}</p>
                </div>
            </div>

            @if ($profile->about)
                <div class="mb-6">
                    <h2 class="text-lg font-semibold text-white mb-2">About</h2>
                    <p class="text-gray-300">{{ $profile->about }}</p>
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <h2 class="text-lg font-semibold text-white mb-3">Personal Information</h2>
                    <div class="space-y-2">
                        <div>
                            <span class="text-gray-400">Country:</span>
                            <span class="text-white ml-2">{{ $profile->country }}</span>
                        </div>
                        @if ($profile->street_address)
                            <div>
                                <span class="text-gray-400">Address:</span>
                                <span class="text-white ml-2">{{ $profile->street_address }}</span>
                            </div>
                        @endif
                        @if ($profile->city)
                            <div>
                                <span class="text-gray-400">City:</span>
                                <span class="text-white ml-2">{{ $profile->city }}</span>
                            </div>
                        @endif
                        @if ($profile->region)
                            <div>
                                <span class="text-gray-400">State/Province:</span>
                                <span class="text-white ml-2">{{ $profile->region }}</span>
                            </div>
                        @endif
                        @if ($profile->postal_code)
                            <div>
                                <span class="text-gray-400">Postal Code:</span>
                                <span class="text-white ml-2">{{ $profile->postal_code }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="flex space-x-4 pt-6 border-t border-gray-700">
                <a href="{{ route('profiles.edit', $profile) }}"
                    class="rounded-md bg-yellow-500 px-4 py-2 text-sm font-semibold text-white hover:bg-yellow-600 transition-colors">
                    Edit Profile
                </a>
                <form action="{{ route('profiles.destroy', $profile) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="rounded-md bg-red-500 px-4 py-2 text-sm font-semibold text-white hover:bg-red-600 transition-colors"
                        onclick="return confirm('Are you sure you want to delete this profile?')">
                        Delete Profile
                    </button>
                </form>
                <a href="{{ route('profiles.index') }}"
                    class="rounded-md bg-gray-700 px-4 py-2 text-sm font-semibold text-white hover:bg-gray-600 transition-colors">
                    Back to List
                </a>
            </div>
        </div>
    </div>
@endsection
