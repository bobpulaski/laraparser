<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'project_id',
        'chapter_id',
        'ext_header_name',
        'ext_result',
        'created_at',
        'updated_at',
    ];

    public static function toBase()
    {
    }


}
