<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Data extends Model
{
    use HasFactory;

    protected $fillable = [
        'electrocardiograma',
        'frecuencia_cardiaca',
        'temperatura',
        'frecuencia_respiratoria',
        'saturacion'
    ];

    public static function getLineChartData()
    {

        $query = Self::orderBy("id", "desc")->take(12)->get();
        $query = $query->sortBy("id");
        $array = [
            "ecg" => [],
            "created_at" => []
        ];

        if ($query->count() > 0) {
            foreach ($query as $item) {
                $ecg = $item->electrocardiograma;
                settype($ecg, "double");
                $created_at = $item->created_at->format('H:i:s');
                settype($created_at, "string");

                array_push($array["ecg"], $ecg);
                array_push($array["created_at"], $created_at);
            }
        }

        return $array;
    }

    public static function getOverall()
    {
        $query = Self::latest()->take(1)->get();
        $query = $query["0"]->attributes;

        return $query;
    }

    public static function getRecords($type)
    {
        $target = null;
        $array = null;
        switch ($type) {
            case 0:
                $target = "frecuencia_cardiaca";
                break;
            case 1:
                $target = "temperatura";
                break;
            case 2:
                $target = "frecuencia_respiratoria";
                break;
            case 3:
                $target = "saturacion";
                break;
        }
        if ($target != null) {

            $query = Self::take(12)->orderBy("created_at", "asc")->get();
            $array = [];
            foreach ($query as $item) {
                $created_at = $item->created_at;
                settype($created_at, "string");
                $array_item = [
                    "value" => $item[$target],
                    "created_at" => $created_at
                ];
                array_push($array, $array_item);
            }
        }

        return $array;
    }
}
