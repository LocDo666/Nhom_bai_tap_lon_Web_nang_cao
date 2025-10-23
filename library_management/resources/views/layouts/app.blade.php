<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>📚 Quản Lý Thư Viện</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        
        body {
            background: url("{{ asset('images/background.jpg') }}") no-repeat center center fixed;
            background-size: cover;
            background-attachment: fixed;
            color: #f5f5f5;
            font-family: 'Segoe UI', sans-serif;
            position: relative;
            z-index: 0;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.75); 
            z-index: -1;
        }

        /
        .navbar {
            background: linear-gradient(90deg, #1a1a1a, #400000);
            box-shadow: 0 2px 10px #d32f2f50;
        }

        
        .navbar-brand {
            font-weight: bold;
            color: #ff4d4d !important;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-shadow: 0 0 8px #ff4d4d, 0 0 15px #b30000;
            transition: 0.3s;
        }
        .navbar-brand:hover {
            color: #ff6666 !important;
            text-shadow: 0 0 12px #ff8080, 0 0 24px #b30000, 0 0 36px #ff0000;
            transform: scale(1.05);
        }

        
        .glow {
            animation: pulseGlow 2.5s infinite alternate;
        }

        @keyframes pulseGlow {
            from { text-shadow: 0 0 5px #ff3333, 0 0 10px #b30000; }
            to { text-shadow: 0 0 15px #ff6666, 0 0 25px #ff0000; }
        }

        .nav-link {
            color: #ccc !important;
            transition: 0.3s;
        }
        .nav-link:hover {
            color: #ff4c4c !important;
        }

        .card {
            background-color: rgba(27, 27, 27, 0.85);
            border: 1px solid #2a2a2a;
            border-radius: 12px;
            transition: 0.3s;
            backdrop-filter: blur(4px);
        }
        .card:hover {
            border-color: #d32f2f;
            transform: translateY(-3px);
        }

        .btn-danger, .btn-primary, .btn-success {
            border: none;
            transition: 0.3s;
        }
        .btn-danger:hover, .btn-primary:hover, .btn-success:hover {
            transform: scale(1.05);
            opacity: 0.9;
        }

        table {
            color: #f5f5f5;
        }
        table thead {
            background-color: rgba(34, 34, 34, 0.9);
        }
        table tbody tr:hover {
            background-color: rgba(34, 34, 34, 0.5);
        }

        .footer {
            text-align: center;
            color: #999;
            padding: 15px;
            border-top: 1px solid #222;
            margin-top: 40px;
            font-size: 0.95rem;
        }
        .footer a {
            color: #ff4444;
            text-decoration: none;
        }
        .footer a:hover {
            color: #ff7777;
            text-decoration: underline;
        }

        
        .pagination {
            justify-content: center;
            margin-top: 20px;
        }
        .page-link {
            background: #1a1a1a;
            color: #f5f5f5;
            border: 1px solid #333;
            transition: 0.3s;
        }
        .page-link:hover {
            background: #d32f2f;
            color: #fff;
        }
        .active > .page-link,
        .page-item.active .page-link {
            background: #d32f2f;
            border-color: #d32f2f;
            color: #fff;
        }
        .disabled > .page-link {
            background: #222;
            color: #777;
            cursor: not-allowed;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
    <div class="container">
        <a class="navbar-brand glow" href="{{ route('books.index') }}">
            📚 Thư viện liu tiu riu
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard') }}">📊 Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('books.index') }}">📖 Sách</a>
                </li>

                {{-- 🔽 Dropdown chọn thể loại để lọc sách --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-warning" href="#" id="categoryDropdown" role="button" data-bs-toggle="dropdown">
                        🗂️ Thể loại
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark bg-dark border-secondary">
                        @php
                            $categories = [
                                'Hành động – Phiêu lưu', 'Kỳ ảo', 'Khoa học viễn tưởng', 'Trinh thám',
                                'Giật gân – Hồi hộp', 'Lãng mạn', 'Kinh dị', 'Lịch sử giả tưởng',
                                'Văn học nghệ thuật', 'Trẻ em & Thiếu niên', 'Thể loại chéo',
                                'Tự truyện – Hồi ký', 'Tiểu sử', 'Lịch sử', 'Khoa học', 'Công nghệ',
                                'Kinh doanh – Kinh tế', 'Chính trị – Xã hội học', 'Triết học',
                                'Tôn giáo & Tâm linh', 'Nghệ thuật', 'Văn hóa & Du lịch',
                                'Giáo dục – Học thuật', 'Tự lực & Phát triển bản thân', 'Sức khỏe & Tâm lý',
                                'Hướng dẫn & Thực hành', 'Tội phạm thật', 'Báo chí & Chính luận',
                                'Ký sự', 'Nghệ thuật sống & Đời thường', 'Tài liệu chuyên môn'
                            ];
                        @endphp
                        @foreach($categories as $c)
                            <li>
                                <a class="dropdown-item text-light" 
                                   href="{{ route('books.index', ['category' => $c]) }}">
                                    {{ $c }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>

                {{-- 👤 Người dùng đăng nhập --}}
                @auth
                    @if(auth()->user()->isAdmin())
                        <li class="nav-item">
                            <a class="nav-link text-warning" href="{{ route('admin.dashboard') }}">🛠 Admin</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">@csrf
                            <button class="btn btn-outline-danger btn-sm ms-2">Đăng xuất</button>
                        </form>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>


    <div class="container">
        @yield('content')
    </div>

    

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
