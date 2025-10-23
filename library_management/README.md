
## ⚙️ YÊU CẦU HỆ THỐNG

| Phần mềm | Phiên bản |
|-----------|-----------|
| PHP | >= 8.1 |
| Composer | >= 2.5 |
| Laravel | 10.x |
| Node.js & npm *(tùy chọn)* | >= 18 |
| XAMPP / Laragon / MAMP | tùy hệ điều hành |

---

##  HƯỚNG DẪN CÀI ĐẶT DỰ ÁN

### 🔹 Bước 1: Sao chép dự án
Nếu bạn đã được gửi thư mục `library_management`, chỉ cần giải nén vào ổ đĩa (ví dụ `C:\demo_Web\library_management`).

Hoặc clone bằng Git:
```bash
git clone https://github.com/<username>/library_management.git
cd library_management
🔹 Bước 2: Cài thư viện PHP
bash
Sao chép mã
composer install
🔹 Bước 3: Tạo file .env
Tạo file .env ở thư mục gốc nếu chưa có, dán nội dung sau:

env
Sao chép mã
APP_NAME="Library Management"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://127.0.0.1:8000

LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=sqlite
DB_DATABASE=C:\demo_Web\library_management\database\database.sqlite

CACHE_DRIVER=database
SESSION_DRIVER=database
QUEUE_CONNECTION=sync

FILESYSTEM_DISK=public
🔹 Bước 4: Tạo file database SQLite
Mở PowerShell hoặc CMD tại thư mục database của project và chạy:

bash
Sao chép mã
type nul > database.sqlite
🔹 Bước 5: Sinh APP_KEY và migrate database
bash
Sao chép mã
php artisan key:generate
php artisan migrate
🔹 Bước 6: Chạy dự án
bash
Sao chép mã
php artisan serve
Truy cập: 👉 http://127.0.0.1:8000

TÀI KHOẢN MẶC ĐỊNH
Nếu có seed dữ liệu mẫu:

graphql
Sao chép mã
Email: admin@gmail.com
Mật khẩu: 123456
Nếu chưa có, bạn có thể đăng ký tài khoản mới trên trang đăng nhập.

CẤU TRÚC DỰ ÁN
bash
Sao chép mã
library_management/
│
├── app/                # Code chính: Models, Controllers, Requests
├── database/           # File SQLite, migrations, seeders
├── public/             # Assets: CSS, JS, hình ảnh
├── resources/views/    # Giao diện Blade
├── routes/web.php      # Định tuyến web
├── artisan             # File Artisan CLI
├── composer.json       # Thông tin package PHP
└── .env                # File cấu hình môi trường
LỖI THƯỜNG GẶP
Lỗi Cách khắc phục
Could not open input file: artisan  Kiểm tra bạn có đang ở thư mục gốc (library_management) không
Database file does not exist    Kiểm tra lại đường dẫn DB_DATABASE trong file .env
no such table   Chạy lại php artisan migrate

TÍNH NĂNG CHÍNH
Quản lý sách (thêm/sửa/xóa/tìm kiếm)
Dashboard thống kê
Xuất dữ liệu PDF & Excel
Hỗ trợ SQLite & MySQL
Phân quyền người dùng (Admin / User)
