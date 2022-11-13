<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    public static function getLineChartData()
    {
        $query = electrocardiogramas::getAmmount(12, true);
        $array = [
            "ecg" => [],
            "created_at" => []
        ];

        if ($query->count() > 0) {
            foreach ($query as $item) {
                $ecg = $item->value;
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
        $array = [
            "frecuencia_cardiaca" => 0,
            "frecuencia_respiratoria" => 0,
            "saturacion" => 0,
            "temperatura" => 0
        ];
        $query = frecuencias_cardiacas::getLatest();
        if ($query) {
            $array["frecuencia_cardiaca"] = $query->value;
            $timestamp = $query->created_at->format('d/m/Y H:i:s');
            settype($created_at, "string");
            $array["frecuencia_cardiaca_timestamp"] = $timestamp;
        }
        $query = frecuencias_respiratorias::getLatest();
        if ($query) {
            $array["frecuencia_respiratoria"] = $query->value;
            $timestamp = $query->created_at->format('d/m/Y H:i:s');
            settype($created_at, "string");
            $array["frecuencia_respiratoria_timestamp"] = $timestamp;
        }
        $query = saturaciones::getLatest();
        if ($query) {
            $array["saturacion"] = $query->value;
            $timestamp = $query->created_at->format('d/m/Y H:i:s');
            settype($created_at, "string");
            $array["saturacion_timestamp"] = $timestamp;
        }
        $query = temperaturas::getLatest();
        if ($query) {
            $array["temperatura"] = $query->value;
            $timestamp = $query->created_at->format('d/m/Y H:i:s');
            settype($created_at, "string");
            $array["temperatura_timestamp"] = $timestamp;
        }

        return $array;
    }

    public static function getRecords($type, $ammount)
    {
        $query = null;
        $array = null;
        switch ($type) {
            case 0:
                $query = frecuencias_cardiacas::getAmmount($ammount, true);
                break;
            case 1:
                $query = temperaturas::getAmmount($ammount, true);
                break;
            case 2:
                $query = frecuencias_respiratorias::getAmmount($ammount, true);
                break;
            case 3:
                $query = saturaciones::getAmmount($ammount, true);
                break;
            default:
                break;
        }
        if ($query) {

            $array = [];
            foreach ($query as $item) {
                $created_at = $item->created_at->format('d/m/Y H:i:s');
                settype($created_at, "string");
                $array_item = [
                    "value" => $item->value,
                    "created_at" => $created_at
                ];
                array_push($array, $array_item);
            }
        }

        return $array;
    }
}
