<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\electrocardiogramas;
use App\Models\frecuencias_cardiacas;
use App\Models\frecuencias_respiratorias;
use App\Models\saturaciones;
use App\Models\temperaturas;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{

    public function addData(Request $request)
    {
        $response = "";
        if ($request->electrocardiograma && count($request->electrocardiograma) > 0) {
            foreach ($request->electrocardiograma as $item) {
                electrocardiogramas::create([
                    "value" => $item,
                    "machine_id" => 0
                ]);
                $response .= "Electrocardiograma " . $item . " agregado, ";
            }
        }
        if ($request->frecuencia_cardiaca) {
            frecuencias_cardiacas::create([
                "value" => $request->frecuencia_cardiaca,
                "machine_id" => 0
            ]);
            $response .= "frecuencia_cardiaca " . $request->frecuencia_cardiaca . " agregada, ";
        }
        if ($request->temperatura) {
            temperaturas::create([
                "value" => $request->temperatura,
                "machine_id" => 0
            ]);
            $response .= "temperatura " . $request->temperatura . " agregada, ";
        }
        if ($request->saturacion) {
            saturaciones::create([
                "value" => $request->saturacion,
                "machine_id" => 0
            ]);
            $response .= "saturacion " . $request->saturacion . " agregado, ";
        }
        if ($request->frecuencia_respiratoria) {
            frecuencias_respiratorias::create([
                "value" => $request->frecuencia_respiratoria,
                "machine_id" => 0
            ]);
            $response .= "frecuencia_respiratoria " . $request->frecuencia_respiratoria . " agregada";
        }
        return ["message" => $response];
    }

    public function addImage(Request $request)
    {
        $data = base64_decode($request->data);
        Storage::disk('public')->put("uploaded_image.jpg", $data);
        return ["message" => 'Imagen Actualizada'];
    }

    public function addAudio(Request $request)
    {
        $data = base64_decode($request->data);
        Storage::disk('public')->put("uploaded_audio.wav", $data);
        return ["message" => 'Audio Actualizado'];
    }
}
