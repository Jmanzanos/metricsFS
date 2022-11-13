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
            "value" => 100.1,
            "machine_id" => 0
        ]);
        electrocardiogramas::create([
            "value" => 105.1,
            "machine_id" => 0
        ]);
        electrocardiogramas::create([
            "value" => 110.1,
            "machine_id" => 0
        ]);
        electrocardiogramas::create([
            "value" => 115.1,
            "machine_id" => 0
        ]);
        electrocardiogramas::create([
            "value" => 120.1,
            "machine_id" => 0
        ]);
        electrocardiogramas::create([
            "value" => 125.1,
            "machine_id" => 0
        ]);
        electrocardiogramas::create([
            "value" => 130.1,
            "machine_id" => 0
        ]);
        electrocardiogramas::create([
            "value" => 135.1,
            "machine_id" => 0
        ]);
        electrocardiogramas::create([
            "value" => 140.1,
            "machine_id" => 0
        ]);
        electrocardiogramas::create([
            "value" => 145.1,
            "machine_id" => 0
        ]);
        electrocardiogramas::create([
            "value" => 150.1,
            "machine_id" => 0
        ]);
        electrocardiogramas::create([
            "value" => 155.1,
            "machine_id" => 0
        ]);
        frecuencias_cardiacas::create([
            "value" => 65,
            "machine_id" => 0
        ]);
        temperaturas::create([
            "value" => 75.5,
            "machine_id" => 0
        ]);
        frecuencias_respiratorias::create([
            "value" => 85,
            "machine_id" => 0
        ]);
        saturaciones::create([
            "value" => 120,
            "machine_id" => 0
        ]);

        Files::create([
            'image' => '/users/0/uploaded_image.jpg',
            'audio' => '/users/0/uploaded_audio.wav',
            "machine_id" => 0
        ]);
    }
}
