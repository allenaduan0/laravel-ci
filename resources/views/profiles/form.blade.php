@php
    $isEdit = isset($profile);
    $route = $isEdit ? route('profiles.update', $profile) : route('profiles.store');
    $method = $isEdit ? 'PUT' : 'POST';
@endphp

<form action="{{ $route }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf
    @if ($isEdit)
        @method('PUT')
    @endif

    <div class="space-y-12">
        <div class="border-b border-white/10 pb-12">
            <h2 class="text-base/7 font-semibold text-white">Profile</h2>
            <p class="mt-1 text-sm/6 text-gray-400">This information will be displayed publicly so be careful what you
                share.</p>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-4">
                    <label for="username" class="block text-sm/6 font-medium text-white">Username *</label>
                    <div class="mt-2">
                        <div
                            class="flex items-center rounded-md bg-white/5 pl-3 outline-1 -outline-offset-1 outline-white/10 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-500">
                            <div class="shrink-0 text-base text-gray-400 select-none sm:text-sm/6">workcation.com/</div>
                            <input id="username" type="text" name="username"
                                value="{{ old('username', $profile->username ?? '') }}" placeholder="janesmith"
                                class="block min-w-0 grow bg-transparent py-1.5 pr-3 pl-1 text-base text-white placeholder:text-gray-500 focus:outline-none sm:text-sm/6" />
                        </div>
                        @error('username')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="col-span-full">
                    <label for="about" class="block text-sm/6 font-medium text-white">About</label>
                    <div class="mt-2">
                        <textarea id="about" name="about" rows="3"
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6">{{ old('about', $profile->about ?? '') }}</textarea>
                    </div>
                    <p class="mt-3 text-sm/6 text-gray-400">Write a few sentences about yourself.</p>
                    @error('about')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-full">
                    <label class="block text-sm/6 font-medium text-white">Photo</label>
                    <div class="mt-2 flex items-center gap-x-3">
                        @if ($isEdit && $profile->photo_path)
                            <div class="relative">
                                <img src="{{ Storage::url($profile->photo_path) }}" alt="Profile Photo"
                                    class="size-12 rounded-full object-cover">
                                <label class="absolute -top-1 -right-1">
                                    <input type="checkbox" name="remove_photo" value="1" class="hidden"
                                        id="remove_photo">
                                    <button type="button" onclick="document.getElementById('remove_photo').click()"
                                        class="bg-red-500 text-white rounded-full size-5 flex items-center justify-center hover:bg-red-600">
                                        <i class="fas fa-times text-xs"></i>
                                    </button>
                                </label>
                            </div>
                        @else
                            <svg viewBox="0 0 24 24" fill="currentColor" data-slot="icon" aria-hidden="true"
                                class="size-12 text-gray-500">
                                <path
                                    d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                                    clip-rule="evenodd" fill-rule="evenodd" />
                            </svg>
                        @endif

                        <div>
                            <input id="photo" name="photo" type="file" class="hidden" accept="image/*">
                            <label for="photo"
                                class="rounded-md bg-white/10 px-3 py-2 text-sm font-semibold text-white inset-ring inset-ring-white/5 hover:bg-white/20 cursor-pointer">
                                {{ $isEdit && $profile->photo_path ? 'Change Photo' : 'Upload Photo' }}
                            </label>
                            <p class="mt-1 text-xs text-gray-400">PNG, JPG, GIF up to 10MB</p>
                            @error('photo')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="col-span-full">
                    <label class="block text-sm/6 font-medium text-white">Cover photo</label>
                    <div class="mt-2 flex justify-center rounded-lg border border-dashed border-white/25 px-6 py-10">
                        <div class="text-center">
                            @if ($isEdit && $profile->cover_photo_path)
                                <div class="mb-4">
                                    <img src="{{ Storage::url($profile->cover_photo_path) }}" alt="Cover Photo"
                                        class="max-h-48 rounded-lg mx-auto">
                                    <div class="mt-2">
                                        <input type="checkbox" name="remove_cover_photo" value="1"
                                            id="remove_cover_photo" class="hidden">
                                        <button type="button"
                                            onclick="document.getElementById('remove_cover_photo').click()"
                                            class="text-sm text-red-400 hover:text-red-300">
                                            <i class="fas fa-trash mr-1"></i>Remove cover photo
                                        </button>
                                    </div>
                                </div>
                            @else
                                <svg viewBox="0 0 24 24" fill="currentColor" data-slot="icon" aria-hidden="true"
                                    class="mx-auto size-12 text-gray-600">
                                    <path
                                        d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z"
                                        clip-rule="evenodd" fill-rule="evenodd" />
                                </svg>
                            @endif

                            <div class="mt-4 flex text-sm/6 text-gray-400 justify-center">
                                <input id="cover_photo" name="cover_photo" type="file" class="hidden"
                                    accept="image/*">
                                <label for="cover_photo"
                                    class="relative cursor-pointer rounded-md bg-transparent font-semibold text-indigo-400 focus-within:outline-2 focus-within:outline-offset-2 focus-within:outline-indigo-500 hover:text-indigo-300">
                                    <span>Upload a file</span>
                                </label>
                                <p class="pl-1">or drag and drop</p>
                            </div>
                            <p class="text-xs/5 text-gray-400">PNG, JPG, GIF up to 10MB</p>
                            @error('cover_photo')
                                <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="border-b border-white/10 pb-12">
            <h2 class="text-base/7 font-semibold text-white">Personal Information</h2>
            <p class="mt-1 text-sm/6 text-gray-400">Use a permanent address where you can receive mail.</p>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <label for="first-name" class="block text-sm/6 font-medium text-white">First name *</label>
                    <div class="mt-2">
                        <input id="first-name" type="text" name="first_name"
                            value="{{ old('first_name', $profile->first_name ?? '') }}" autocomplete="given-name"
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        @error('first_name')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="last-name" class="block text-sm/6 font-medium text-white">Last name *</label>
                    <div class="mt-2">
                        <input id="last-name" type="text" name="last_name"
                            value="{{ old('last_name', $profile->last_name ?? '') }}" autocomplete="family-name"
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        @error('last_name')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="sm:col-span-4">
                    <label for="email" class="block text-sm/6 font-medium text-white">Email address *</label>
                    <div class="mt-2">
                        <input id="email" type="email" name="email"
                            value="{{ old('email', $profile->email ?? '') }}" autocomplete="email"
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        @error('email')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="country" class="block text-sm/6 font-medium text-white">Country *</label>
                    <div class="mt-2 grid grid-cols-1">
                        <select id="country" name="country" autocomplete="country-name"
                            class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white/5 py-1.5 pr-8 pl-3 text-base text-white outline-1 -outline-offset-1 outline-white/10 *:bg-gray-800 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6">
                            <option value="">Select a country</option>
                            <option value="Australia"
                                {{ old('country', $profile->country ?? '') == 'Australia' ? 'selected' : '' }}>
                                Australia</option>
                            <option value="Canada"
                                {{ old('country', $profile->country ?? '') == 'Canada' ? 'selected' : '' }}>Canada
                            </option>
                            <option value="France"
                                {{ old('country', $profile->country ?? '') == 'France' ? 'selected' : '' }}>France
                            </option>
                            <option value="Germany"
                                {{ old('country', $profile->country ?? '') == 'Germany' ? 'selected' : '' }}>Germany
                            </option>
                            <option value="Japan"
                                {{ old('country', $profile->country ?? '') == 'Japan' ? 'selected' : '' }}>Japan
                            </option>
                            <option value="Spain"
                                {{ old('country', $profile->country ?? '') == 'Spain' ? 'selected' : '' }}>Spain
                            </option>
                            <option value="United Kingdom"
                                {{ old('country', $profile->country ?? '') == 'United Kingdom' ? 'selected' : '' }}>
                                United Kingdom</option>
                            <option value="United States"
                                {{ old('country', $profile->country ?? '') == 'United States' ? 'selected' : '' }}>
                                United States</option>
                        </select>
                        <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true"
                            class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-400 sm:size-4">
                            <path
                                d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"
                                clip-rule="evenodd" fill-rule="evenodd" />
                        </svg>
                    </div>
                    @error('country')
                        <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                    @enderror
                </div>

                <div class="col-span-full">
                    <label for="street-address" class="block text-sm/6 font-medium text-white">Street address</label>
                    <div class="mt-2">
                        <input id="street-address" type="text" name="street_address"
                            value="{{ old('street_address', $profile->street_address ?? '') }}"
                            autocomplete="street-address"
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        @error('street_address')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="sm:col-span-2 sm:col-start-1">
                    <label for="city" class="block text-sm/6 font-medium text-white">City</label>
                    <div class="mt-2">
                        <input id="city" type="text" name="city"
                            value="{{ old('city', $profile->city ?? '') }}" autocomplete="address-level2"
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        @error('city')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="region" class="block text-sm/6 font-medium text-white">State / Province</label>
                    <div class="mt-2">
                        <input id="region" type="text" name="region"
                            value="{{ old('region', $profile->region ?? '') }}" autocomplete="address-level1"
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        @error('region')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <label for="postal-code" class="block text-sm/6 font-medium text-white">ZIP / Postal code</label>
                    <div class="mt-2">
                        <input id="postal-code" type="text" name="postal_code"
                            value="{{ old('postal_code', $profile->postal_code ?? '') }}" autocomplete="postal-code"
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6" />
                        @error('postal_code')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
        <a href="{{ route('profiles.index') }}"
            class="text-sm/6 font-semibold text-white hover:text-gray-300 transition-colors">
            Cancel
        </a>
        <button type="submit"
            class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white hover:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500 transition-colors">
            {{ $isEdit ? 'Update' : 'Create' }} Profile
        </button>
    </div>
</form>
