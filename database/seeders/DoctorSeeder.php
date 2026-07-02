<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Doctor;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        Doctor::create([
            'username' => 'Gary Vergara',          // ← cambia esto
            'password' => Hash::make('123456'), // ← cambia esto
            'name'     => 'Dr. Gary Vergara',
        ]);
    }
}