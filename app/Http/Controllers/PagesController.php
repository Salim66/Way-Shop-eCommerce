<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Pages view
     */
    public function pages()
    {
        $all_data = Pages::latest()->get();
        return view('admin.pages.view_pages', compact('all_data'));
    }
}
