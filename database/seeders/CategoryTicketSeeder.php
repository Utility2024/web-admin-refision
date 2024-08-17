<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CategoryTicket;

class CategoryTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'HR', 'description' => 'Human Resources related tickets'],
            ['name' => 'GA', 'description' => 'General Affairs related tickets'],
            ['name' => 'Utility Facility', 'description' => 'Tickets related to facility management and utilities'],
            ['name' => 'Electrostatic Discharge', 'description' => 'Tickets related to ESD (Electrostatic Discharge) issues'],
        ];

        foreach ($categories as $category) {
            CategoryTicket::create($category);
        }
    }
}
