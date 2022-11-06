<?php

namespace App\Http\Controllers;

use App\Models\Files;
use Illuminate\Http\Request;

class FileController extends Controller
{
    public function getFile($type)
    {
        $items = Files::getRecords($type);

        return view('components.index-records', [
            'items' => $items
        ]);
    }
}
