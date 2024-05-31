<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class StudentReportExportController extends Controller
{
    public function exportPdf(Request $request)
    {
        $students = Student::query()
            ->select("first_name", "last_name", "email", "course", "age", "birth_date")
            ->take(10)
            ->get();

        $pdf = Pdf::loadView('exports.student_report', compact('students'));

        return $pdf->download('student_report.pdf');
    }
}
