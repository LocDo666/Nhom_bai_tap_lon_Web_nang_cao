@extends('layouts.app')

@section('content')
<div class="card p-4 shadow-lg">
    <h3 class="text-danger mb-4">➕ Thêm Sách Mới</h3>

    <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- 📖 Tên sách --}}
        <div class="mb-3">
            <label class="form-label text-light">📖 Tên sách</label>
            <input type="text" name="title" value="{{ old('title') }}"
                   class="form-control bg-dark text-light border-secondary" required>
            @error('title') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        {{-- ✍️ Tác giả --}}
        <div class="mb-3">
            <label class="form-label text-light">✍️ Tác giả</label>
            <input type="text" name="author" value="{{ old('author') }}"
                   class="form-control bg-dark text-light border-secondary" required>
            @error('author') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        {{-- 🏢 Nhà xuất bản --}}
        <div class="mb-3">
            <label class="form-label text-light">🏢 Nhà xuất bản</label>
            <input type="text" name="publisher" value="{{ old('publisher') }}"
                   class="form-control bg-dark text-light border-secondary">
        </div>

        {{-- 🗂️ Thể loại --}}
        <div class="mb-3">
            <label class="form-label text-light">🗂️ Thể loại</label>
            <select name="category" class="form-select bg-dark text-light border-secondary" required>
                <option value="">-- Chọn thể loại --</option>
                @php
                    $categories = [
                        'Hành động – Phiêu lưu',
                        'Kỳ ảo',
                        'Khoa học viễn tưởng',
                        'Trinh thám',
                        'Giật gân – Hồi hộp',
                        'Lãng mạn',
                        'Kinh dị',
                        'Lịch sử giả tưởng',
                        'Văn học nghệ thuật',
                        'Trẻ em & Thiếu niên',
                        'Thể loại chéo',
                        'Tự truyện – Hồi ký',
                        'Tiểu sử',
                        'Lịch sử',
                        'Khoa học',
                        'Công nghệ',
                        'Kinh doanh – Kinh tế',
                        'Chính trị – Xã hội học',
                        'Triết học',
                        'Tôn giáo & Tâm linh',
                        'Nghệ thuật',
                        'Văn hóa & Du lịch',
                        'Giáo dục – Học thuật',
                        'Tự lực & Phát triển bản thân',
                        'Sức khỏe & Tâm lý',
                        'Hướng dẫn & Thực hành',
                        'Tội phạm thật',
                        'Báo chí & Chính luận',
                        'Ký sự',
                        'Nghệ thuật sống & Đời thường',
                        'Tài liệu chuyên môn'
                    ];
                @endphp
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ old('category') == $cat ? 'selected' : '' }}>
                        {{ $cat }}
                    </option>
                @endforeach
            </select>
            @error('category') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        {{-- 📅 Năm xuất bản + 📦 Số lượng --}}
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label text-light">📅 Năm xuất bản</label>
                <input type="number" name="year" value="{{ old('year') }}"
                       class="form-control bg-dark text-light border-secondary">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label text-light">📦 Số lượng</label>
                <input type="number" name="quantity" value="{{ old('quantity', 1) }}"
                       class="form-control bg-dark text-light border-secondary">
            </div>
        </div>

        {{-- 🖼️ Ảnh bìa --}}
        <div class="mb-3">
            <label class="form-label text-light">🖼️ Ảnh bìa</label>
            <input type="file" name="cover_image" class="form-control bg-dark text-light border-secondary">
            @error('cover_image') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
        </div>

        {{-- 📝 Mô tả --}}
        <div class="mb-3">
            <label class="form-label text-light">📝 Mô tả</label>
            <textarea name="description" rows="4"
                      class="form-control bg-dark text-light border-secondary">{{ old('description') }}</textarea>
        </div>

        {{-- 💾 Nút hành động --}}
        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-danger">💾 Lưu sách</button>
            <a href="{{ route('books.index') }}" class="btn btn-secondary">⬅️ Quay lại</a>
        </div>
    </form>
</div>
@endsection
