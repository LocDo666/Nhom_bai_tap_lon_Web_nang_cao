<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    // 📚 Danh sách sách + tìm kiếm + lọc + sắp xếp
    public function index(Request $request)
    {
        $query = Book::query();

        // 🔍 Tìm kiếm theo tiêu đề hoặc tác giả
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('author', 'like', '%' . $request->search . '%');
            });
        }

        // 🏷️ Lọc theo thể loại
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        // 📅 Lọc theo năm xuất bản
        if ($request->filled('year')) {
            $query->where('year', $request->year);
        }

        // 🔽 Sắp xếp theo lựa chọn
        switch ($request->sort) {
            case 'latest':
                $query->orderBy('created_at', 'desc');
                break;
            case 'views':
                $query->orderBy('views', 'desc');
                break;
            case 'downloads':
                $query->orderBy('downloads', 'desc');
                break;
            default:
                $query->orderBy('title', 'asc'); // sắp xếp mặc định theo tên
        }

        // 📖 Phân trang + giữ tham số truy vấn
        $books = $query->paginate(10)->withQueryString();

        // 🧩 Lấy danh sách thể loại duy nhất
        $categories = Book::select('category')
            ->whereNotNull('category')
            ->distinct()
            ->pluck('category');

        // 📦 Truyền dữ liệu sang view
        return view('books.index', compact('books', 'categories'));
    }

    // 👁️ Hiển thị chi tiết 1 sách + tăng lượt xem
    public function show(Book $book)
    {
        $book->increment('views');
        return view('books.show', compact('book'));
    }

    // ➕ Form thêm sách
    public function create()
    {
        return view('books.create');
    }

    // 💾 Lưu sách mới
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|max:255',
            'author'      => 'required|max:255',
            'publisher'   => 'nullable|string|max:255',
            'year'        => 'nullable|integer',
            'description' => 'nullable|string',
            'category'    => 'nullable|string|max:255',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only([
            'title', 'author', 'publisher', 'year',
            'description', 'category'
        ]);

        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $data['views'] = 0;
        $data['downloads'] = 0;

        Book::create($data);

        return redirect()->route('books.index')->with('success', 'Thêm sách thành công!');
    }

    // ✏️ Form sửa sách
    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    // 🔄 Cập nhật sách
    public function update(Request $request, Book $book)
    {
        $request->validate([
            'title'       => 'required|max:255',
            'author'      => 'required|max:255',
            'publisher'   => 'nullable|string|max:255',
            'year'        => 'nullable|integer',
            'description' => 'nullable|string',
            'category'    => 'nullable|string|max:255',
            'cover_image' => 'nullable|image|max:2048',
        ]);

        $data = $request->only([
            'title', 'author', 'publisher', 'year',
            'description', 'category'
        ]);

        if ($request->hasFile('cover_image')) {
            if ($book->cover_image) {
                Storage::disk('public')->delete($book->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $book->update($data);

        return redirect()->route('books.index')->with('success', 'Cập nhật sách thành công!');
    }

    // ❌ Xóa sách
    public function destroy(Book $book)
    {
        if ($book->cover_image) {
            Storage::disk('public')->delete($book->cover_image);
        }

        $book->delete();

        return redirect()->route('books.index')->with('success', 'Xóa sách thành công!');
    }

    // 📥 Tải file (nếu có)
    public function download(Book $book)
    {
        if (!$book->file_path || !Storage::disk('public')->exists($book->file_path)) {
            return back()->with('error', 'Không tìm thấy file để tải xuống.');
        }

        $book->increment('downloads');
        return Storage::disk('public')->download($book->file_path);
    }
}
