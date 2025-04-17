@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <div class="row g-4">
            <!-- Form thêm từ -->
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header text-white" style="background-color: #4e73df;">
                        <h5 class="mb-0"><i class="bi bi-plus-circle me-2"></i>Thêm Từ Thay Đổi</h5>
                    </div>
                    <div class="card-body" style="background-color: #f8f9fc;">
                        <form action="{{ route('add.word.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="original" class="form-label">Từ Gốc</label>
                                <input type="text" name="original" id="original" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="replacement" class="form-label">Từ Thay Thế</label>
                                <input type="text" name="replacement" id="replacement" class="form-control" required>
                            </div>
                            <button type="submit" class="btn w-100 text-white" style="background-color: #36b9cc;">
                                <i class="bi bi-check-circle me-1"></i> Thêm Từ
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Kết quả -->
            <div class="col-md-6">
                <div class="card shadow-sm border-0">
                    <div class="card-header text-white" style="background-color: #4e73df;">
                        <h5 class="mb-0"><i class="bi bi-list-check me-2"></i>Kết Quả Thêm Từ</h5>
                    </div>
                    <div class="card-body" style="background-color: #f8f9fc;">
                        <h6 class="mb-3 text-muted">Danh sách từ đã thay đổi:</h6>
                        <form id="delete-form" action="{{ route('delete.words') }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <div class="table-responsive" style="max-height: 400px; overflow-y: auto;">
                                <table class="table table-bordered align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col">
                                                <input type="checkbox" id="select-all" />
                                            </th>
                                            <th scope="col">Từ Gốc</th>
                                            <th scope="col">Từ Thay Thế</th>
                                            <th scope="col">Hành Động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($replacements as $replacement)
                                            <tr>
                                                <td>
                                                    <input type="checkbox" name="ids[]" value="{{ $replacement->id }}" class="select-item" />
                                                </td>
                                                <td>{{ $replacement->original }}</td>
                                                <td>{{ $replacement->replacement }}</td>
                                                <td>
                                                    <button type="button" class="btn btn-sm btn-outline-danger delete-btn" data-id="{{ $replacement->id }}">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <button type="submit" class="btn btn-danger w-100" id="delete-selected">Xóa Chọn</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Hiển thị thông báo thành công nếu có -->
    @if(session('success'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true
            });
        </script>
    @endif

    <!-- Hiển thị thông báo lỗi nếu có -->
    @if(session('error'))
        <script>
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true
            });
        </script>
    @endif

    <script>
        document.querySelectorAll('.delete-btn').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            
            const id = this.getAttribute('data-id');
        
            Swal.fire({
                title: 'Xác nhận xóa?',
                text: "Hành động này không thể khôi phục!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#e74a3b',
                cancelButtonColor: '#6c757d',
                confirmButtonText: 'Xóa',
                cancelButtonText: 'Hủy'
            }).then((result) => {
                if (result.isConfirmed) {
                    fetch(`/delete-word/${id}`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'success',
                                title: 'Đã xóa!',
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true
                            });
                            this.closest('tr').remove();
                        } else {
                            Swal.fire({
                                toast: true,
                                position: 'top-end',
                                icon: 'error',
                                title: 'Có lỗi xảy ra!',
                                showConfirmButton: false,
                                timer: 1500,
                                timerProgressBar: true
                            });
                        }
                    })
                    .catch(error => {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: 'error',
                            title: 'Lỗi khi xóa!',
                            showConfirmButton: false,
                            timer: 1500,
                            timerProgressBar: true
                        });
                    });
                }
            });
        });
    });

    // Xử lý xóa nhiều mục
    document.getElementById('delete-selected').addEventListener('click', function(e) {
        e.preventDefault();

        const selectedIds = [];
        document.querySelectorAll('.select-item:checked').forEach(checkbox => {
            selectedIds.push(checkbox.value);
        });

        if (selectedIds.length === 0) {
            Swal.fire({
                toast: true,
                position: 'top-end',
                icon: 'error',
                title: 'Vui lòng chọn ít nhất một từ để xóa!',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true
            });
            return;
        }

        Swal.fire({
            title: 'Xác nhận xóa?',
            text: "Hành động này không thể khôi phục!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#e74a3b',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Xóa',
            cancelButtonText: 'Hủy'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('delete-form');
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'ids';
                input.value = selectedIds.join(',');

                form.appendChild(input);
                form.submit();
            }
        });
    });
    document.getElementById('select-all').addEventListener('change', function () {
    const isChecked = this.checked;
    document.querySelectorAll('.select-item').forEach(checkbox => {
        checkbox.checked = isChecked;
    });
});

    </script>
@endsection
