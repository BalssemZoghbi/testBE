<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Donnees\Projet;
use PhpOffice\PhpWord\TemplateProcessor;

class WordExportController extends Controller
{
    public function wordExport($id)
    {
        $projet = Projet::findOrFail($id);
        $templateProcessor = new TemplateProcessor('projet.docx');

    }
}
