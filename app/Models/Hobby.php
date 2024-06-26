<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hobby extends Model
{
    use HasFactory;

    protected $table = 'hobbies';

    protected $fillable = [
        'curriculum_id',
        'hobby',
    ];

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class);
    }
}
