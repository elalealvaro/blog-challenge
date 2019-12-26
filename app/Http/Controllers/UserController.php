<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\HiddenContent;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\UpdateTweetVisibilityRequest;

class UserController extends Controller
{
    /**
     * Show user's profile.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(User $user)
    {
        $entries = $user->entries()->orderBy('created_at', 'DESC')->paginate(5);
        $tweets = $user->getTweets();

        return view('user.show', compact('user', 'entries', 'tweets'));
    }

    /**
     * Show a form to edit user's profile.
     */
    public function edit(User $user)
    {
        if (Auth::user()->id !== $user->id) {
            return abort(403, 'Unauthorized action.');
        }
        return view('user.edit', compact('user'));
    }

    /**
     * Update user's profile.
     */
    public function update(User $user, UpdateUserRequest $request)
    {
        if ($user->update($request->all())) {
            flash('Your profile has been updated successfully.');
            return redirect($user->permalink);
        }
        flash('Something went wrong during the update. Please retry.')->error();
        return redirect()->back()->withInput($request::all());
    }

    /**
     * Set tweet visibility.
     */
    public function tweet(User $user, UpdateTweetVisibilityRequest $request)
    {
        try {
            $id = $request->input('id');
            $action = $request->input('action');

            switch($action) {
                case 'show':
                    $hidden = $user->hiddenContents()
                        ->where('type', '=', 'twitter')
                        ->where('external_id', '=', $id)
                        ->first();
                    if ($hidden) {
                        $hidden->delete();
                    }
                break;
                case 'hide':
                    $user->hiddenContents()->create([
                        'type' => 'twitter',
                        'external_id' => $id,
                    ]);
                break;
            }

            return response()->json([
                'status' => 'success'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong trying to update the tweet visibility.',
            ], 404);
        }
    }
}
