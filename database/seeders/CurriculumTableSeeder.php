<?php

namespace Database\Seeders;

use App\Models\Curriculum;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurriculumTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Limpar a tabela antes de inserir os registros
        Curriculum::truncate();

        // Inserir registros na tabela
        Curriculum::factory()->count(10)->create();
    }
}
