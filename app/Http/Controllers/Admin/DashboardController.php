<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'page_title' => 'Dashboard',
        ];

        return view('dashboard.index')->with(array_merge($this->data, $data));
    }
}
