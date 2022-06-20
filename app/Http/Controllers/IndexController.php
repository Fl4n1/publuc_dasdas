<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')->take(15)->get();
        $posts = Post::orderBy('id', 'desc')->take(15)->get();

        return view('index', compact('posts', 'products'));
    }
}
