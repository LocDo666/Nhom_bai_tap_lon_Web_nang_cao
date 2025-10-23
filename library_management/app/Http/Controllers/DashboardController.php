<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Borrow;

class DashboardController extends Controller
{
    public function index() {
        $totalBooks = Book::count();
        $totalUsers = User::count();
        $totalBorrows = Borrow::count();
        $booksBorrowed = Borrow::where('status', 'borrowed')->count();

        return view('admin.dashboard', compact('totalBooks', 'totalUsers', 'totalBorrows', 'booksBorrowed'));
    }
}
