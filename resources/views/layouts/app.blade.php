<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Thay Đổi Từ</title>
    
    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>


    <style>
        /* Các kiểu chung cho body và html để chiếm hết chiều cao */
        html, body {
            height: 100%;
            margin: 0;
            display: flex;
            flex-direction: column;
        }

        /* Nội dung trang chính (container) chiếm không gian còn lại */
        .container {
            flex-grow: 1;
        }

        /* Hiệu ứng hover cho navbar links */
        .navbar-nav .nav-link {
            transition: color 0.3s ease, background-color 0.3s ease;
            border-radius: 6px;
            padding: 6px 12px;
        }

        .navbar-nav .nav-link:hover {
            color: #1face1 !important;
            background-color: rgba(255, 255, 255, 0.1);
        }

        /* Dropdown menu hiệu ứng đẹp */
        .dropdown-menu {
            transition: all 0.3s ease;
            border-radius: 0.5rem;
        }

        .dropdown-menu .dropdown-item:hover {
            background-color: #1face1;
            color: #fff;
        }

        .navbar-toggler {
            border: none;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        /* Footer luôn ở dưới cùng */
        footer {
            background-color: #1e2a38;
            text-align: center;
            color: white;
            padding: 1rem 0;
            margin-top: auto; /* Đẩy footer xuống cuối */
        }
    </style>

</head>
<body>
    <nav class="navbar navbar-expand-lg" style="background-color: #1e2a38;">
        <div class="container">
          <!-- Logo và chữ tabneit bên trái -->
          <a class="navbar-brand text-white fw-bold d-flex align-items-center" href="/">
            <i class="bi bi-chat-dots-fill me-2"></i>
            <span class="fs-5">Tabneit</span>
          </a>
      
          <!-- Nút toggle cho responsive -->
          <button class="navbar-toggler text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
          </button>
      
          <!-- Menu điều hướng bên phải -->
          <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
              <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('srt.index') }}">
                  <i class="bi bi-file-earmark-arrow-down-fill"></i> SRT->TXT
                </a>
              </li>
                <li class="nav-item">
                    <a class="nav-link text-white" href="/">
                        <i class="bi bi-pencil-square me-2"></i> Nhập văn bản
                    </a>
                  </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="{{ route('add.word') }}">
                  <i class="bi bi-plus-circle"></i> Thêm Từ
                </a>
              </li>
              @auth
                <li class="nav-item dropdown">
                  <a class="nav-link text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                    <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <a class="dropdown-item" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="bi bi-box-arrow-right"></i> Đăng xuất
                      </a>
                    </li>
                  </ul>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
                </form>
              @else
                <li class="nav-item">
                  <a class="nav-link text-white" href="{{ route('login') }}">
                    <i class="bi bi-box-arrow-in-right"></i> Đăng nhập
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link text-white" href="{{ route('register') }}">
                    <i class="bi bi-person-plus"></i> Đăng ký
                  </a>
                </li>
              @endauth
            </ul>
          </div>
        </div>
      </nav>

    <div class="container mt-4">
        @yield('content')
    </div>

    <footer>
        <p class="mb-0">© 2025 Tabneit. Bản quyền thuộc về <strong>Tabneit</strong></p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
