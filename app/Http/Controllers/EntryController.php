<?php

namespace App\Http\Controllers;

use Auth;
use App\Entry;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateEntryRequest;

class EntryController extends Controller
{
    /**
     * Show a form to create an entry.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create()
    {
        return view('entry.create');
    }

    /**
     * Show a form to edit an entry.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit(Entry $entry)
    {
        if (Auth::user()->id !== $entry->user->id) {
            return abort(403, 'Unauthorized action.');
        }
        return view('entry.edit', compact('entry'));
    }

    /**
     * Create a new entry.
     */
    public function save(UpdateEntryRequest $request)
    {
        if (Auth::user()->entries()->create($request->all())) {
            flash('Your entry has been created successfully.');
            return redirect(Auth::user()->permalink);
        }
        flash('Something went wrong. Please retry.')->error();
        return redirect()->back()->withInput($request::all());
    }

    /**
     * Update an entry.
     */
    public function update(Entry $entry, UpdateEntryRequest $request)
    {
        if ($entry->update($request->all())) {
            flash('Your entry has been updated successfully.');
            return redirect('/');
        }
        flash('Something went wrong during the update. Please retry.')->error();
        return redirect()->back()->withInput($request::all());
    }
}
