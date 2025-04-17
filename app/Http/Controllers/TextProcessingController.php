<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TextProcessingController extends Controller
{
    public function processText(Request $request)
    {
        $inputText = $request->input('input_text');

        if (!$inputText) {
            return response()->json(['error' => 'No input text provided'], 400);
        }

        return response()->json(['result' => $inputText]);
    }

    public function uppercase(Request $request)
    {
        $inputText = $request->input('input_text');
        if (!$inputText) {
            return response()->json(['error' => 'No input text provided'], 400);
        }

        $resultText = strtoupper($inputText);

        return response()->json(['result' => $resultText]);
    }

    public function sentenceCase(Request $request)
    {
        $inputText = $request->input('input_text');
        if (!$inputText) {
            return response()->json(['error' => 'No input text provided'], 400);
        }

        // Thay dấu phẩy thành dấu chấm và in hoa chữ cái đầu tiên
        $resultText = preg_replace_callback('/(?:^|\.\s+|,)([a-z])/', function($matches) {
            return strtoupper($matches[0]);
        }, str_replace(',', '.', $inputText));

        return response()->json(['result' => $resultText]);
    }
}

