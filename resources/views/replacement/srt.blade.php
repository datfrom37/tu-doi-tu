@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Kéo thả file -->
        <div class="col-md-6">
            <div id="drop-area" class="border rounded p-4 text-center" style="background-color: #f8f9fc;">
                <h5>Kéo và thả file .srt vào đây</h5>
                <p class="text-muted">Hoặc click để chọn file</p>
                <input type="file" id="fileElem" accept=".srt" hidden>
                <button class="btn btn-primary" id="fileSelect">Chọn file</button>
            </div>
        </div>

        <!-- Kết quả -->
        <div class="col-md-6">
            <div class="border rounded p-4" style="background-color: #f8f9fc; min-height: 300px;">
                <h5>Kết quả chuyển đổi</h5>
                <form action="{{ route('srt.convert') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="file" name="file" accept=".srt" required>
                    <button type="submit" class="btn btn-success mt-3">Chuyển đổi</button>
                </form>
                
                <!-- Hiển thị kết quả chuyển đổi nếu có -->
                @if (isset($convertedText))
                    <pre class="mt-3" style="white-space: pre-wrap;">{{ $convertedText }}</pre>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
