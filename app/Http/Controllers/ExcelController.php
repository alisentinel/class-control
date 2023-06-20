<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExcelImport;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ExcelController extends Controller
{
    public function index()
    {
        // Excel::import(new ExcelImport, 'original.xlsx');
    }
    public function import(Request $request)
    {
        // if file is empty returns error
        if (!$request->hasFile('file')) {
            return response()->json([
                'status' => 'error',
                'message' => 'No file uploaded'
            ], 400);
        }

        // Try to import the file
        Excel::import(new ExcelImport, $request->file('file'));

        return response()->json([
            'status' => 'success',
            'message' => 'File uploaded'
        ], 200);
    }
}
