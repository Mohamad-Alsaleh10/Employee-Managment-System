<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Department::create([
            'name' => 'Managment department',
            'description' => 'hello this is Managment department'
        ]);

        Department::create([
            'name' => 'HR department',
            'description' => 'hello this is HR department'
        ]);

        Department::create([
            'name' => 'Software Engineering',
            'description' => 'HR department Software Engineering '
        ]);
    }
}
