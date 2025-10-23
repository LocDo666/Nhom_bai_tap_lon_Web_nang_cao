<?php

namespace App\Http\Controllers;

use App\Models\Borrow;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BorrowController extends Controller
{
    public function index() {
        $borrows = Borrow::with(['book', 'user'])->latest()->paginate(10);
        return view('borrows.index', compact('borrows'));
    }

    public function create() {
        $books = Book::all();
        return view('borrows.create', compact('books'));
    }

    public function store(Request $request) {
        $request->validate([
            'book_id' => 'required|exists:books,id'
        ]);

        Borrow::create([
            'book_id' => $request->book_id,
            'user_id' => Auth::id(),
            'borrow_date' => now(),
            'status' => 'borrowed'
        ]);

        return redirect()->route('borrows.index')->with('success', 'Đã mượn sách thành công!');
    }

    public function edit(Borrow $borrow) {
        return view('borrows.edit', compact('borrow'));
    }

    public function update(Request $request, Borrow $borrow) {
        if ($request->status === 'returned') {
            $borrow->update([
                'status' => 'returned',
                'return_date' => now()
            ]);
        }
        return redirect()->route('borrows.index')->with('success', 'Cập nhật trạng thái thành công!');
    }

    public function destroy(Borrow $borrow) {
        $borrow->delete();
        return redirect()->route('borrows.index')->with('success', 'Đã xóa bản ghi mượn sách!');
    }
}
