<?php

namespace App\Http\Controllers\Backend\UserProfile;

use Illuminate\Http\Request;
use SweetAlert2\Laravel\Swal;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserProfileUpdateController extends Controller
{
    //* PROFILE UPDATE INDEX
    public function index()
    {
        return view("backend.profile.index");
    }

    //*PROFILE INFO UPDATE
    public function userInfoUpdate(Request $request)
    {
        dd($request->all());
    }

    //* PROFILE IMAGE UPDATE
    public function userprofileUpdate(Request $request)
    {
        $request->validate([
            'profile_image' => 'required|mimes:png,jpg,webp',
        ]);
        $profileImage = Auth::user();
        // dd($profileImage);

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = 'profile' . time() . '.' . $image->getClientOriginalName();
            // dd($imageName);
            $pathName = 'profile/';
            if (!file_exists($pathName)) {
                mkdir($pathName, 0755, true);
            }
            $image->move($pathName, $imageName);
            $profileImage->profile_image = $imageName;
            $profileImage->save();
            Swal::success([
                'title' => 'Profile Image Uploded!',
            ]);
            return back();
        }
    }
}
