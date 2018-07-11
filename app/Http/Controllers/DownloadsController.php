<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadsController extends Controller
{
    public function download($path, $name) {
	    
	    return Storage::download($path . '/' . $name);
	}
}
