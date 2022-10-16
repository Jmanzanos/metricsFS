<?php

namespace App\Http\Controllers;

use App\Models\Data;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    
    public function addData(Request $request){

        return Data::create($request->all());
    }
}
