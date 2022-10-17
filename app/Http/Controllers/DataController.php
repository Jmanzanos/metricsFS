<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;

class DataController extends Controller
{
    
    public function index()
    {
        $json = Self::getUpdate();
        $data = json_decode($json);

        $data->ecg = json_encode($data->ecg);
        $data->created_at = json_encode($data->created_at);

        return view('index', ["data" => $data]);
    }

    public function getRecords($type)
    {
        $items = Data::getRecords($type);

        return view('components.index-records', [
            'items' => $items
        ]);
    }

    public function getUpdate()
    {
        $lineChartData = Data::getLineChartData();
        $overallData = Data::getOverall();
        $ecg = $lineChartData["ecg"];
        $created_at = $lineChartData["created_at"];
        $json = [
            'ecg' => $ecg,
            'created_at' => $created_at,
            'overallData' => $overallData
        ];

        $json = json_encode($json);

        return $json;
    }
}
