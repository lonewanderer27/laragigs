<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    // get all listings
    public function index() {
        return view("listings.index", [
            'listings' => Listing::all()
        ]);
    }

    // show single listing
    public function show(Listing $listing) {
        return view("listing.show", [
            'listing' => $listing
        ]);
    }
}
