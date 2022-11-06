<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{

    public function addData(Request $request)
    {

        return Data::create($request->all());
    }

    public function addImage(Request $request)
    {
        $data = base64_decode($request->data);
        Storage::disk('public')->put("uploaded_image.png", $data);
        return ["message" => 'Imagen Actualizada'];
    }

    public function addAudio(Request $request)
    {
        $data = base64_decode($request->data);
        Storage::disk('public')->put("uploaded_audio.wav", $data);
        return ["message" => 'Audio Actualizado'];
    }
}
