<?php

namespace App\Http\Controllers\User;

use App\User;
use App\Profile;
use Illuminate\Http\Request;
use App\Http\Traits\ImageTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ProfileRequest;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    use ImageTrait;

    const FOLDER_NAME = 'images';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::with('profile')->find(Auth::user()->id);

        if ($user->profile && $user->profile->photo) {
            $explodePublic = explode('public', $user->profile->photo);

            $profilePhoto = $explodePublic[1];
        } else {
            $profilePhoto = 'nopreview.png';
        }

        return view('user.dashboard', ['user' => $user, 'profilePhoto' => $profilePhoto]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProfileRequest
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request)
    {
        DB::beginTransaction();

        try {
            $user = User::find(Auth::user()->id);

            $user->name = $request->name;

            $user->save();

            Profile::updateOrCreate(
                ['user_id' => Auth::user()->id],
                [
                    'address' => $request->address,
                    'photo' => $this->storeImageAndGetPath(self::FOLDER_NAME, Auth::user()->id, $request->file('photo')),
                ]
            );

            DB::commit();

            return redirect('/user/dashboard')->with('status', 'Profile updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect('/user/dashboard')->with('status', 'Whoops! Something went wrong. Please try again later.');
        }
    }

    /**
     * Update password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required', 'string', 'min:8'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
   
        return redirect('/user/dashboard')->with('passwordStatus', 'Password changed successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
