@extends('layouts.app')

@section('content')
@if (session('success'))
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                toast: true,
                position: 'top-end', // Góc trên bên phải
                icon: 'success',
                title: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: () => {
                    const sound = new Audio('{{ asset('sounds/success.mp3') }}');
                    sound.play();
                }
            });
        });
    </script>
@endif
    <div class="container mt-4">
        <div class="row g-4">
            <!-- Nhập văn bản -->
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header text-white" style="background-color: #4e73df;">
                        <h5 class="mb-0"><i class="bi bi-pencil-square me-2"></i>Nhập Văn Bản</h5>
                    </div>
                    <div class="card-body" style="background-color: #f8f9fc;">
                        <form action="{{ route('process.text') }}" method="POST">
                            @csrf
                            <textarea name="input_text" rows="10" class="form-control" placeholder="Nhập đoạn văn bản..." style="resize: none; border-radius: 8px;">{{ session('input_text') }}</textarea>
                            <button type="submit" class="btn mt-3 w-100 text-white" style="background-color: #36b9cc; border-radius: 8px;">
                                <i class="bi bi-arrow-right-circle me-1"></i> Xử lý
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Kết quả xử lý -->
            <div class="col-md-6 h-100">
                <div class="card shadow-sm border-0 h-100 d-flex flex-column">
                    <div class="card-header text-white d-flex justify-content-between align-items-center" style="background-color: #4e73df;">
                        <h5 class="mb-0"><i class="bi bi-file-earmark-text me-2"></i>Kết Quả</h5>
                        @if(session('result'))
                            <div class="ms-auto">
                                <button class="btn btn-outline-light btn-sm rounded-circle copy-btn me-2" title="Sao chép">
                                    <i class="bi bi-clipboard"></i>
                                </button>
                                <button class="btn btn-outline-light btn-sm rounded-circle uppercase-btn me-2" title="In hoa tất cả">
                                    <i class="bi bi-type-h1"></i> <!-- Icon cho chức năng in hoa -->
                                </button>
                                <button class="btn btn-outline-light btn-sm rounded-circle sentence-case-btn" title="In hoa chữ cái đầu tiên và sau dấu phẩy/dấu chấm">
                                    <i class="bi bi-fonts"></i>
                                </button>
                            </div>
                        @endif
                    </div>
                    <div class="card-body h-100" style="background-color: #f8f9fc;">
                        @if(session('result'))
                            <div id="resultText" class="p-3 border rounded bg-white" style="max-height: 303px; overflow-y: auto;">
                                {{ session('result') }}
                            </div>
                        @else
                            <p class="text-muted mb-0">Chưa có kết quả xử lý.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script sao chép và các chức năng mới -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const copyBtn = document.querySelector('.copy-btn');
        if (copyBtn) {
            copyBtn.addEventListener('click', function () {
                const resultText = document.getElementById('resultText').innerText;
                navigator.clipboard.writeText(resultText).then(() => {
                    Swal.fire({
                        toast: true,
                        position: 'top-end',
                        icon: 'success',
                        title: 'Đã sao chép!',
                        showConfirmButton: false,
                        timer: 1500,
                        timerProgressBar: true
                    });
                });
            });
        }

        // In hoa tất cả chữ cái
        const uppercaseBtn = document.querySelector('.uppercase-btn');
        if (uppercaseBtn) {
            uppercaseBtn.addEventListener('click', function () {
                const inputText = document.getElementById('resultText').innerText;
                const result = inputText.toUpperCase();
                document.getElementById('resultText').innerText = result;
            });
        }

        // In hoa chữ cái đầu câu
        const sentenceCaseBtn = document.querySelector('.sentence-case-btn');
        if (sentenceCaseBtn) {
            sentenceCaseBtn.addEventListener('click', function () {
                let text = document.getElementById('resultText').innerText;

                // Bước 1: Chuyển toàn bộ thành chữ thường
                text = text.toLowerCase();

                // Bước 2: Thay dấu phẩy thành dấu chấm (và thêm khoảng trắng nếu cần)
                text = text.replace(/,/g, '.');

                // Bước 3: In hoa chữ cái đầu câu (đầu tiên và sau dấu chấm)
                text = text.replace(/(^\s*\w|[\.\!\?]\s*\w)/g, function (match) {
                    return match.toUpperCase();
                });

                // Hiển thị kết quả
                document.getElementById('resultText').innerText = text;
            });
        }

    });
</script>


@endsection
