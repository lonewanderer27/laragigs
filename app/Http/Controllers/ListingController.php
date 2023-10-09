<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // get all listings
    public function index() {
        // dd(request());
        return view("listings.index", [
            'listings' => Listing::latest()->filter(request(['tag', 'search']))->paginate(6)
        ]);
    }

    // show single listing
    public function show(Listing $listing) {
        return view("listings.show", [
            'listing' => $listing
        ]);
    }

    // show create form
    public function create() {
        return view("listings.create");
    }

    // store new listing
    public function store(Request $request) {
        // dd($request->all());
        $formFields = $request->validate([
            'company' => ['required', Rule::unique('listings', 'company')],
            'title' => 'required',              // table name, column name
            'location' => 'required',
            'email' => ['required', 'email'],
            'website' => 'required',
            'tags' => 'required',
            // 'logo' => 'optional|image|max:2048',
            'description' => 'required',
        ]);

        Listing::create($formFields);

        return redirect('/')->with('message', 'Listing created successfully!');
    }
}
