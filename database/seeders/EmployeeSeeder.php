<?php

namespace Database\Seeders;

use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\Division;
use App\Models\Employee;


class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = ['Employee 1', 'Employee 2'];
        $division = Division::firstOrFail(['id']);
        
        foreach ($employees as $employee) {
            Employee::create([
                'id' => Str::uuid(),
                'name' => $employee,
                'phone' => '081234567890',
                'position' => 'Software Engineer',
                'image' => 'https://via.placeholder.com/150',
                'division_id' => $division->id,
            ]);
        }
    }
}
