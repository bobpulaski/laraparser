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

    public function urls ()
    {
        return $this->hasMany (Url::class);
    }

    public function rules ()
    {
        return $this->hasMany (Rule::class);
    }

    public function results ()
    {
        return $this->hasMany (Result::class);
    }

    public function qprogresses ()
    {
        return $this->hasMany (Qprogress::class);
    }


}
