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
            'name' => 'Human Resources',
            'description' => 'Handles all matters related to employee relations and welfare.'
        ]);

        Department::create([
            'name' => 'Engineering',
            'description' => 'Focuses on product development and innovation.'
        ]);

        // You can add as many departments as you need
        Department::create([
            'name' => 'Marketing',
            'description' => 'Promotes the company and its products to the outside world.'
        ]);
    }
}
