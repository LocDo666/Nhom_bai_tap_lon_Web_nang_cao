@extends('layouts.app')

@section('content')
<h2 class="mb-4 text-danger">
    📖 Thư viện số 
    @if(request('category'))
        - <span class="text-warning">{{ request('category') }}</span>
    @else
        - Duyệt tài liệu
    @endif
    <span class="text-light fs-6 ms-2">
        (Tổng: {{ $books->sum('quantity') }} cuốn)
    </span>
</h2>

<form method="GET" class="row g-2 mb-4">
    <div class="col-md-3">
        <input type="text" name="search" value="{{ request('search') }}" class="form-control bg-dark text-light border-danger" placeholder="🔍 Tên sách / Tác giả">
    </div>
    <div class="col-md-2">
        <select name="category" class="form-select bg-dark text-light border-danger">
            <option value="">-- Thể loại --</option>
            @foreach($categories as $c)
                <option value="{{ $c }}" {{ request('category')==$c?'selected':'' }}>{{ $c }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-2">
        <input type="number" name="year" value="{{ request('year') }}" class="form-control bg-dark text-light border-danger" placeholder="Năm XB">
    </div>
    <div class="col-md-2">
        <select name="sort" class="form-select bg-dark text-light border-danger">
            <option value="">-- Sắp xếp --</option>
            <option value="latest" {{ request('sort')=='latest'?'selected':'' }}>📅 Mới nhất</option>
            <option value="views" {{ request('sort')=='views'?'selected':'' }}>🔥 Xem nhiều nhất</option>
            <option value="downloads" {{ request('sort')=='downloads'?'selected':'' }}>⬇️ Tải nhiều nhất</option>
        </select>
    </div>
    <div class="col-md-2">
        <button class="btn btn-danger w-100">Lọc</button>
    </div>
</form>

<div class="d-flex justify-content-between mb-3">
    <a href="{{ route('books.create') }}" class="btn btn-success btn-sm">➕ Thêm Sách</a>
    <div>
        <a href="{{ route('export.pdf') }}" class="btn btn-danger btn-sm">📄 PDF</a>
        <a href="{{ route('export.excel') }}" class="btn btn-primary btn-sm">📊 Excel</a>
    </div>
</div>

<div class="card p-3">
    <table class="table table-dark table-hover table-bordered align-middle">
        <thead>
            <tr class="text-danger">
                <th>#</th>
                <th>Bìa</th>
                <th>Tên sách</th>
                <th>Tác giả</th>
                <th>Thể loại</th>
                <th>Năm</th>
                <th>Lượt xem</th>
                <th>Số lượng</th> 
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($books as $book)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>
                    @if($book->cover_image)
                        <img src="{{ asset('storage/'.$book->cover_image) }}" width="50" class="rounded shadow-sm">
                    @endif
                </td>
                <td>
                    <a href="{{ route('books.show', $book->id) }}" class="text-light text-decoration-none fw-semibold">
                        {{ $book->title }}
                    </a>
                </td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->category ?? '—' }}</td>
                <td>{{ $book->year ?? '—' }}</td>
                <td>{{ $book->views }}</td>

                
                <td>
                    @if($book->quantity > 0)
                        <span class="badge bg-success">{{ $book->quantity }}</span>
                    @else
                        <span class="badge bg-danger">Hết</span>
                    @endif
                </td>

                <td>
                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-sm btn-warning">✏️</a>
                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Xóa sách này?')">🗑️</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="9" class="text-center text-secondary py-4">
                    Không có sách nào phù hợp với bộ lọc.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="mt-3">
        {{ $books->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection
