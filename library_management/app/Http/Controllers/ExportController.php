<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\BooksExport;

class ExportController extends Controller
{
    public function exportPDF() {
        $books = Book::all();
        $pdf = Pdf::loadView('books.export_pdf', compact('books'));
        return $pdf->download('books_list.pdf');
    }

    public function exportExcel() {
        return Excel::download(new BooksExport, 'books_list.xlsx');
    }
}
