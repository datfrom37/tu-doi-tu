<?php

namespace App\Http\Controllers;

use App\Models\Replacement;
use Illuminate\Http\Request;

class ReplacementController extends Controller
{
    // Phương thức hiển thị trang chủ (index)
    public function index()
    {
        // Lấy tất cả từ thay đổi từ database
        $replacements = Replacement::all();

        // Trả về view 'replacement.index' và truyền dữ liệu
        return view('replacement.index', compact('replacements'));
    }

    // Phương thức hiển thị form thêm từ thay đổi
    public function addWordForm()
    {
        // Lấy tất cả các từ thay thế từ database
        $replacements = Replacement::all();

        // Trả về view với danh sách từ thay thế
        return view('replacement.add-word', compact('replacements'));
    }


    // Phương thức xử lý form thêm từ thay đổi
    public function store(Request $request)
    {
        // Xác thực dữ liệu nhập vào
        $request->validate([
            'original' => 'required|string',
            'replacement' => 'required|string',
        ]);

        // Kiểm tra nếu từ gốc đã tồn tại trong cơ sở dữ liệu
        $existingOriginal = Replacement::where('original', $request->original)->first();
        if ($existingOriginal) {
            return redirect()->route('add.word')->with('error', 'Từ gốc đã tồn tại!');
        }

        // Kiểm tra nếu từ thay thế đã tồn tại trong cơ sở dữ liệu
        $existingReplacement = Replacement::where('replacement', $request->replacement)->first();
        if ($existingReplacement) {
            return redirect()->route('add.word')->with('error', 'Từ thay thế đã tồn tại!');
        }

        // Lưu từ thay thế vào cơ sở dữ liệu
        Replacement::create([
            'original' => $request->original,
            'replacement' => $request->replacement,
        ]);

        // Trả về thông báo thành công
        return redirect()->route('add.word')->with('success', 'Thêm từ thành công');
    }


    // Phương thức xử lý văn bản
    public function processText(Request $request)
    {
        $request->validate([
            'input_text' => 'required|string',
        ]);

        $text = $request->input('input_text');
        $replacements = Replacement::all();

        foreach ($replacements as $rep) {
            $text = preg_replace('/\b' . preg_quote($rep->original, '/') . '\b/ui', $rep->replacement, $text);
        }

        // Lưu lại kết quả và văn bản gốc vào session
        return redirect('/')
            ->with('result', $text)
            ->with('input_text', $request->input('input_text'));
    }

    public function destroy($id)
    {
        $replacement = Replacement::find($id);
        if ($replacement) {
            $replacement->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['success' => false]);
    }
    public function deleteMultiple(Request $request)
    {
        // Kiểm tra nếu có các ID được chọn
        $ids = explode(',', $request->input('ids', ''));
        
        // Xóa các từ theo ID
        Replacement::whereIn('id', $ids)->delete();

        return redirect()->route('add.word')->with('success', 'Đã xóa các từ thành công');
    }

    

}
