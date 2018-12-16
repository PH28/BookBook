<?php

namespace Book\Http\Controllers;

use Illuminate\Http\Request;
use Book\Category;
use Book\Product;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $new_products = Product::orderBy('created_at', 'desc')->limit(12)->get();

        return view('home', compact('new_products'));
    }
}