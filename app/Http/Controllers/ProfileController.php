<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\Profile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profiles = Profile::latest()->paginate(10);
        $trashedCount = Profile::onlyTrashed()->count();
        return view('profiles.index', compact('profiles', 'trashedCount'));
    }

    public function create()
    {
        return view('profiles.create');
    }

    public function store(StoreProfileRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('photo')) {
            $validated['photo_path'] = $request->file('photo')->store('photos', 'public');
        }

        if ($request->hasFile('cover_photo')) {
            $validated['cover_photo_path'] = $request->file('cover_photo')->store('cover_photo', 'public');
        }

        Profile::create($validated);

        return redirect()->route('profiles.index')->with('success', 'Profile created successfully.');
    }

    public function show(Profile $profile)
    {
        return view('profiles.show', compact('profile'));
    }

    public function edit(Profile $profile)
    {
        return view('profiles.edit', compact('profile'));
    }

    public function update(UpdateProfileRequest $request, Profile $profile)
    {

        $validated = $request->validated();

        if ($request->hasFile('photo')) {
            if ($profile->photo_path) {
                Storage::disk('public')->delete($profile->photo_path);
            }

            $validated['photo_path'] = $request->file('photo')->store('photos', 'public');
        }

        if ($request->hasFile('cover_photo')) {
            if ($profile->cover_photo_path) {
                Storage::disk('public')->delete($profile->cover_photo_path);
            }

            $validated['cover_photo_path'] = $request->file('cover_photo')->store('cover_photos', 'public');
        }

        if ($request->input('remove_photo')) {
            if ($profile->photo_path) {
                Storage::disk('public')->delete($profile->photo_path);
                $validated['photo_path'] = null;
            }
        }

        if ($request->input('remove_cover_photo')) {
            if ($profile->cover_photo_path) {
                Storage::disk('public')->delete($profile->cover_photo_path);
                $validated['cover_photo_path'] = null;
            }
        }

        $profile->update($validated);

        return redirect()->route('profiles.show', $profile)->with('success', 'Profile updated successfully.');
    }

    public function destroy(Profile $profile)
    {
        if ($profile->photo_path) {
            Storage::disk('public')->delete($profile->photo_path);
        }

        if ($profile->cover_photo_path) {
            Storage::disk('public')->delete($profile->cover_photo_path);
        }

        $profile->delete();

        return redirect()->route('profiles.index')->with('success', 'Profile deleted successfully');
    }

    public function restore($id)
    {
        $profile = Profile::withTrashed()->findOrFail($id);

        $profile->restore();

        return redirect()->route('profiles.index')->with('success', 'Profile restored successfully');
    }

    public function forceDelete($id)
    {
        $profile = Profile::withTrashed()->findOrFail($id);

        if ($profile->photo_path) {
            Storage::disk('public')->delete($profile->photo_path);
        }

        if ($profile->cover_photo_path) {
            Storage::dis('public')->delete($profile->cover_photo_path);
        }

        $profile->forceDelete();

        return redirect()->route('profiles.index')->with('success', 'Profile permanently deleted successfully');
    }

    public function trashed()
    {
        $profiles = Profile::onlyTrashed()->latest()->paginate(10);
        return view('profiles.trashed', compact('profiles'));
    }
}
