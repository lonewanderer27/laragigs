<?php

use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Route;
use App\Models\Listing;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Common Resource Routes:
// index    show all listings
// show     show a listing
// create   show form to create new listing
// store    store new listing
// edit     edit a listing
// update   update a listing
// destroy  remove a listing

// All Listings
Route::get("/", [ListingController::class, 'index']);

// Show Create Form
Route::get("/listings/create", [ListingController::class, 'create']);

// Store Listing
Route::post("/listings", [ListingController::class, 'store']);

// Single Listing
Route::get("/listings/{listing}", [ListingController::class, 'show']);
