<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Chapter
 *
 * @method static \Illuminate\Database\Eloquent\Builder|Chapter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chapter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Chapter query()
 * @mixin \Eloquent
 */
class Chapter extends Model
{
    use HasFactory;

    public function projects ()
    {
        $this->hasMany (Project::class);
    }

    public function users ()
    {
        $this->belongsToMany (User::class);
    }
}
