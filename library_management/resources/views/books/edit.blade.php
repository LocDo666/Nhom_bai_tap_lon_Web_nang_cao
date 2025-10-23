@extends('layouts.app')

@section('content')
<div class="card p-4 shadow-lg">
    <h3 class="text-danger mb-4">✏️ Chỉnh sửa sách</h3>

    <form action="{{ route('books.update', $book->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label text-light">📖 Tên sách</label>
            <input type="text" name="title" value="{{ old('title', $book->title) }}"
                   class="form-control bg-dark text-light border-secondary" required>
            @error('title') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label text-light">✍️ Tác giả</label>
            <input type="text" name="author" value="{{ old('author', $book->author) }}"
                   class="form-control bg-dark text-light border-secondary" required>
        </div>

        <div class="mb-3">
            <label class="form-label text-light">🏢 Nhà xuất bản</label>
            <input type="text" name="publisher" value="{{ old('publisher', $book->publisher) }}"
                   class="form-control bg-dark text-light border-secondary">
        </div>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label text-light">📅 Năm xuất bản</label>
                <input type="number" name="year" value="{{ old('year', $book->year) }}"
                       class="form-control bg-dark text-light border-secondary">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label text-light">📦 Số lượng</label>
                <input type="number" name="quantity" value="{{ old('quantity', $book->quantity ?? 1) }}"
                       class="form-control bg-dark text-light border-secondary">
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label text-light">🖼️ Ảnh bìa hiện tại</label>
            @if($book->cover_image)
                <div class="mb-2">
                    <img src="{{ asset('storage/'.$book->cover_image) }}" alt="cover" style="max-height:120px;">
                </div>
            @else
                <div class="text-muted small mb-2">Chưa có ảnh bìa</div>
            @endif
            <label class="form-label text-light">Thay ảnh bìa</label>
            <input type="file" name="cover_image" class="form-control bg-dark text-light border-secondary">
            @error('cover_image') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        <div class="mb-3">
            <label class="form-label text-light">📝 Mô tả</label>
            <textarea name="description" rows="4"
                      class="form-control bg-dark text-light border-secondary">{{ old('description', $book->description) }}</textarea>
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-danger">💾 Cập nhật</button>
            <a href="{{ route('books.index') }}" class="btn btn-secondary">⬅️ Quay lại</a>
        </div>
    </form>
</div>
@endsection
