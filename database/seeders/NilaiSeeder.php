<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Sesuaikan path file dengan lokasi file nilai.sql Anda
        $path = database_path('seeders/sql/nilai.sql');
        $sql = file_get_contents($path);

        DB::unprepared($sql);

        $this->command->info('Data from nilai.sql has been imported successfully.');
    }
}