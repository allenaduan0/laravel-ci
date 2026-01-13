@extends('layouts.app')

@section('title', 'All Profiles')

@section('content')
    <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-700">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-white">All Profiles</h2>
                    <p class="text-gray-400 mt-1">List of all user profiles</p>
                </div>
                <a href="{{ route('profiles.create') }}"
                    class="bg-indigo-500 text-white hover:bg-indigo-600 px-4 py-2 rounded-md text-sm font-medium transition-colors">
                    <i class="fas fa-plus mr-2"></i>Create Profile
                </a>
            </div>
        </div>

        @if ($profiles->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">ID
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                Profile</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                Username</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">Email
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                Country</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-300 uppercase tracking-wider">
                                Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-gray-800 divide-y divide-gray-700">
                        @foreach ($profiles as $profile)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $profile->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        @if ($profile->photo_path)
                                            <img src="{{ Storage::url($profile->photo_path) }}"
                                                alt="{{ $profile->username }}"
                                                class="size-10 rounded-full mr-3 object-cover">
                                        @else
                                            <div
                                                class="size-10 rounded-full bg-gray-700 flex items-center justify-center mr-3">
                                                <i class="fas fa-user text-gray-400"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="text-sm font-medium text-white">
                                                {{ $profile->first_name }} {{ $profile->last_name }}
                                            </div>
                                            <div class="text-xs text-gray-400">
                                                {{ $profile->city ?? 'No city' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-white">{{ $profile->username }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $profile->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-300">{{ $profile->country }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-3">
                                        <a href="{{ route('profiles.show', $profile) }}"
                                            class="text-indigo-400 hover:text-indigo-300" title="View">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('profiles.edit', $profile) }}"
                                            class="text-yellow-400 hover:text-yellow-300" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('profiles.destroy', $profile) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300"
                                                onclick="return confirm('Are you sure you want to delete this profile?')"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="px-6 py-4 border-t border-gray-700">
                <div class="flex justify-between items-center">
                    <div class="text-gray-400 text-sm">
                        Showing {{ $profiles->firstItem() }} to {{ $profiles->lastItem() }} of {{ $profiles->total() }}
                        profiles
                    </div>
                    <div>
                        {{ $profiles->links() }}
                    </div>
                </div>
            </div>
        @else
            <div class="p-8 text-center">
                <i class="fas fa-users text-gray-500 text-4xl mb-4"></i>
                <h3 class="text-xl font-medium text-gray-300 mb-2">No profiles found</h3>
                <p class="text-gray-400 mb-6">Get started by creating your first profile.</p>
                <a href="{{ route('profiles.create') }}"
                    class="inline-flex items-center bg-indigo-500 text-white hover:bg-indigo-600 px-4 py-2 rounded-md text-sm font-medium transition-colors">
                    <i class="fas fa-plus mr-2"></i>Create Profile
                </a>
            </div>
        @endif
    </div>

    @if ($trashedCount > 0)
        <div class="mt-6">
            <a href="{{ route('profiles.trashed') }}" class="text-gray-400 hover:text-white transition-colors">
                <i class="fas fa-trash-alt mr-2"></i>View Deleted Profiles ({{ $trashedCount }})
            </a>
        </div>
    @endif
@endsection
