<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SrtConvertController extends Controller
{
    public function index()
    {
        // Trả về view khi chưa có dữ liệu chuyển đổi
        return view('replacement.srt');
    }

    public function convert(Request $request)
    {
        // Kiểm tra và xử lý file nhập vào
        $request->validate([
            'file' => 'required|file|mimes:srt,txt'
        ]);

        // Đọc nội dung file SRT
        $content = file_get_contents($request->file('file')->getRealPath());

        // Thay thế các từ khóa
        $converted = str_replace(['chết', 'Chết'], ['chớt', 'Chớt'], $content);
        $converted = str_replace(['giết', 'Giết'], ['gi iết', 'Gi iết'], $converted);

        // Xóa số dòng và thời gian
        $converted = preg_replace('/^\d+\s*\n?/m', '', $converted);  // Xóa số dòng
        $converted = preg_replace('/\d{2}:\d{2}:\d{2},\d{3} --> \d{2}:\d{2}:\d{2},\d{3}\s*\n?/m', '', $converted);  // Xóa thời gian


        // Trả về kết quả dưới dạng view với biến 'convertedText'
        return view('replacement.srt', [
            'convertedText' => trim($converted)
        ]);
    }
}


