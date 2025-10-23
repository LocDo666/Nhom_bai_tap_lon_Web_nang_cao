@extends('layouts.app')

@section('content')
<h2 class="mb-4 text-danger">📊 Bảng điều khiển thư viện</h2>

<div class="row g-3">
    <div class="col-md-3">
        <div class="card text-center p-3 border-danger">
            <h5 class="text-light">Tổng số sách</h5>
            <h2 class="text-danger">{{ $totalBooks }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center p-3 border-success">
            <h5 class="text-light">Độc giả</h5>
            <h2 class="text-success">{{ $totalUsers }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center p-3 border-warning">
            <h5 class="text-light">Lượt mượn</h5>
            <h2 class="text-warning">{{ $totalBorrows }}</h2>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card text-center p-3 border-info">
            <h5 class="text-light">Đang mượn</h5>
            <h2 class="text-info">{{ $booksBorrowed }}</h2>
        </div>
    </div>
</div>
@endsection
