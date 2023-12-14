<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ExportInstructorsReport;

class ReportController extends Controller
{
    public function index()
    {
        return view("admin.reports.index");
    }

    public function instructors()
    {
        return Excel::download(new ExportInstructorsReport(), 'reporte_instructores.xlsx');
    }

//    public function students()
//    {
//        return Excel::download(new ExportStudentsReport(), 'reporte_capacitandos.xlsx');
//    }
}
