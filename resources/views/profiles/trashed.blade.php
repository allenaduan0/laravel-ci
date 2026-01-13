@extends('layouts.app')

@section('title', 'Deleted Profiles')

@section('content')
    <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-700">
            <div class="flex justify-between items-center">
                <div>
                    <h2 class="text-2xl font-bold text-white">Deleted Profiles</h2>
                    <p class="text-gray-400 mt-1">Restore or permanently delete profiles</p>
                </div>
                <a href="{{ route('profiles.index') }}"
                    class="bg-gray-700 text-white hover:bg-gray-600 px-4 py-2 rounded-md text-sm font-medium transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Profiles
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
                                Deleted At</th>
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
                                                class="size-10 rounded-full mr-3 object-cover opacity-50">
                                        @else
                                            <div
                                                class="size-10 rounded-full bg-gray-700 flex items-center justify-center mr-3 opacity-50">
                                                <i class="fas fa-user text-gray-400"></i>
                                            </div>
                                        @endif
                                        <div>
                                            <div class="text-sm font-medium text-gray-400">
                                                {{ $profile->first_name }} {{ $profile->last_name }}
                                            </div>
                                            <div class="text-xs text-gray-500">
                                                {{ $profile->city ?? 'No city' }}
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ $profile->username }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">{{ $profile->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                    {{ $profile->deleted_at->format('M d, Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <div class="flex space-x-3">
                                        <form action="{{ route('profiles.restore', $profile) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-green-400 hover:text-green-300"
                                                onclick="return confirm('Restore this profile?')" title="Restore">
                                                <i class="fas fa-trash-restore"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('profiles.force-delete', $profile) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-400 hover:text-red-300"
                                                onclick="return confirm('Permanently delete this profile? This cannot be undone!')"
                                                title="Permanently Delete">
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
                        deleted profiles
                    </div>
                    <div>
                        {{ $profiles->links() }}
                    </div>
                </div>
            </div>
        @else
            <div class="p-8 text-center">
                <i class="fas fa-trash-alt text-gray-500 text-4xl mb-4"></i>
                <h3 class="text-xl font-medium text-gray-300 mb-2">No deleted profiles</h3>
                <p class="text-gray-400 mb-6">All deleted profiles have been restored or permanently removed.</p>
                <a href="{{ route('profiles.index') }}"
                    class="inline-flex items-center bg-gray-700 text-white hover:bg-gray-600 px-4 py-2 rounded-md text-sm font-medium transition-colors">
                    <i class="fas fa-arrow-left mr-2"></i>Back to Profiles
                </a>
            </div>
        @endif
    </div>
@endsection
