<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Data;
use App\Models\electrocardiogramas;
use App\Models\frecuencias_cardiacas;
use App\Models\temperaturas;
use App\Models\frecuencias_respiratorias;
use App\Models\saturaciones;
use App\Models\Files;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        //LLenar la tabla Data con datos temporales
        electrocardiogramas::create([
            "value" => 100.1
        ]);
        electrocardiogramas::create([
            "value" => 105.1
        ]);
        electrocardiogramas::create([
            "value" => 110.1
        ]);
        electrocardiogramas::create([
            "value" => 115.1
        ]);
        electrocardiogramas::create([
            "value" => 120.1
        ]);
        electrocardiogramas::create([
            "value" => 125.1
        ]);
        electrocardiogramas::create([
            "value" => 130.1
        ]);
        electrocardiogramas::create([
            "value" => 135.1
        ]);
        electrocardiogramas::create([
            "value" => 140.1
        ]);
        electrocardiogramas::create([
            "value" => 145.1
        ]);
        electrocardiogramas::create([
            "value" => 150.1
        ]);
        electrocardiogramas::create([
            "value" => 155.1
        ]);
        frecuencias_cardiacas::create([
            "value" => 65
        ]);
        temperaturas::create([
            "value" => 75
        ]);
        frecuencias_respiratorias::create([
            "value" => 85
        ]);
        saturaciones::create([
            "value" => 120
        ]);

        Files::create([
            'ruta_imagen' => '/files/uploaded_image.jpg',
            'ruta_audio' => '/files/uploaded_audio.mp3'
        ]);
    }
}
