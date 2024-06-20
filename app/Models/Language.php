<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $table = 'languages';

    protected $fillable = [
        'curriculum_id',
        'language',
        'level',
    ];

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class);
    }
}
