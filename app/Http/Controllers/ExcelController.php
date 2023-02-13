<?php

namespace App\Http\Controllers;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExcelImport;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class ExcelController extends Controller
{
    public function import(Request $request)
    {
        Excel::import(new ExcelImport, $request->file('file'));
    }
}
