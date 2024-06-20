<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;

    protected $table = 'certifications';

    protected $fillable = [
        'curriculum_id',
        'certification',
        'institution',
        'date',
    ];

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class);
    }
}
