<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Menu;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $menus = Menu::getAllActive(); // Hasil: array of stdClass
        $menuTree = Menu::buildMenuTree($menus);
        // dd($menuTree);
        return view('home', compact('menuTree'));
    }
}
