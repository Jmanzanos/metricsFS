<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Data;
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
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //LLenar la tabla Data con datos temporales
        Data::create([
            'electrocardiograma' => 100.1,
            'frecuencia_cardiaca' => 10, 
            'temperatura' => 20,
            'frecuencia_respiratoria' => 30,
            'saturacion' => 40
        ]);
        Data::create([
            'electrocardiograma' => 105.1,
            'frecuencia_cardiaca' => 15, 
            'temperatura' => 25,
            'frecuencia_respiratoria' => 35,
            'saturacion' => 45
        ]);
        Data::create([
            'electrocardiograma' => 110.1,
            'frecuencia_cardiaca' => 20, 
            'temperatura' => 30,
            'frecuencia_respiratoria' => 40,
            'saturacion' => 50
        ]);
        Data::create([
            'electrocardiograma' => 115.1,
            'frecuencia_cardiaca' => 25, 
            'temperatura' => 35,
            'frecuencia_respiratoria' => 45,
            'saturacion' => 55
        ]);
        Data::create([
            'electrocardiograma' => 120.1,
            'frecuencia_cardiaca' => 30, 
            'temperatura' => 40,
            'frecuencia_respiratoria' => 50,
            'saturacion' => 60
        ]);
        Data::create([
            'electrocardiograma' => 125.1,
            'frecuencia_cardiaca' => 35, 
            'temperatura' => 45,
            'frecuencia_respiratoria' => 55,
            'saturacion' => 65
        ]);
        Data::create([
            'electrocardiograma' => 130.1,
            'frecuencia_cardiaca' => 40, 
            'temperatura' => 50,
            'frecuencia_respiratoria' => 60,
            'saturacion' => 70
        ]);
        Data::create([
            'electrocardiograma' => 135.1,
            'frecuencia_cardiaca' => 45, 
            'temperatura' => 55,
            'frecuencia_respiratoria' => 65,
            'saturacion' => 75
        ]);
        Data::create([
            'electrocardiograma' => 130.1,
            'frecuencia_cardiaca' => 50, 
            'temperatura' => 60,
            'frecuencia_respiratoria' => 70,
            'saturacion' => 80
        ]);
        Data::create([
            'electrocardiograma' => 125.1,
            'frecuencia_cardiaca' => 55, 
            'temperatura' => 65,
            'frecuencia_respiratoria' => 75,
            'saturacion' => 85
        ]);
        Data::create([
            'electrocardiograma' => 120.1,
            'frecuencia_cardiaca' => 60, 
            'temperatura' => 70,
            'frecuencia_respiratoria' => 80,
            'saturacion' => 90
        ]);
        Data::create([
            'electrocardiograma' => 115.1,
            'frecuencia_cardiaca' => 65, 
            'temperatura' => 75,
            'frecuencia_respiratoria' => 85,
            'saturacion' => 120
        ]);

        Files::create([
            'ruta_imagen' => '/files/uploaded_image.jpg',
            'ruta_audio' => '/files/uploaded_audio.mp3'
        ]);
    }
}
