<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    use HasFactory;

    protected $table = 'educations';

    protected $fillable = [
        'curriculum_id',
        'institution',
        'course',
        'start_date',
        'end_date',
        'description',
    ];

    public function curriculum()
    {
        return $this->belongsTo(Curriculum::class);
    }
}
