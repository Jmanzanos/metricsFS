<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class electrocardiogramas extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'machine_id',
    ];
    
    public static function getLatest()
    {
        $query = Self::latest()->get();
        if ($query) {
            $query = $query[0];
        }

        return $query;
    }

    public static function getAmmount(int $ammount, bool $asc = false)
    {
        $query = Self::orderBy("id", "desc")->take($ammount)->get();

        if ($asc) {
            $query = $query->sortBy("id");
        }

        return $query;
    }
}
