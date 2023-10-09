<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // get all listings
    public function index()
    {
        // dd(request());
        return view("listings.index", [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    // show single listing
    public function show(Listing $listing)
    {
        return view("listings.show", [
            'listing' => $listing
        ]);
    }

    // show create form
    public function create()
    {
        return view("listings.create");
    }

    // store new listing
    public function store(Request $request)
    {
        // dd($request->all());
        $formFields = $request->validate([
            'company' => ['required', Rule::unique('listings', 'company')],
                                                // table name, column name
            'title' => 'required',
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required',
        ]);

        // if there is a logo
        // then upload the filePath to the database
        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully!');
    }

    // show edit form
    public function edit(Listing $listing)
    {
        return view("listings.edit", [
            'listing' => $listing
        ]);
    }

    // update listing
    public function update(Request $request, Listing $listing)
    {
        $formFields = $request->validate([
            'company' => 'required',
            'title' => 'required',
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => 'required',
            'tags' => 'required',
            'description' => 'required',
        ]);

        // if there is a logo
        // then upload the filePath to the database
        if ($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $listing->create($formFields);

        return back()->with('message', 'Listing updated successfully!');
    }

    // Delete listing
    public function destroy(Listing $listing) {
        $listing->delete();
        return redirect('/')->with('message', "Listing deleted successfully!");
    }
}