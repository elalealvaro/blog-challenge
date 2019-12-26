<?php

namespace App\Http\Controllers;

use App\User;
use App\Entry;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Get entries ids and user ids
        $entries = Entry::orderBy('created_at', 'DESC')->get(['id', 'user_id'])->toArray();

        // Count and get only the last 3 posts of each user
        $entry_ids = [];
        $user_counter = [];
        foreach($entries as $entry) {
            $user_id = $entry['user_id'];
            if (!isset($user_counter[$user_id])) {
                $user_counter[$user_id] = 0;
            }
            if ($user_counter[$user_id] < 3) {
                $user_counter[$user_id]++;
                array_push($entry_ids, $entry['id']);
            }
        }

        // Query and paginate the previous entry list
        $entries = Entry::whereIn('id', $entry_ids)->orderBy('created_at', 'DESC')->paginate(5);

        // Return the view
        return view('home', compact('entries'));
    }
}
