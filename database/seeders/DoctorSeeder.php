<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Doctor;

class DoctorSeeder extends Seeder
{
    public function run(): void
    {
        if (Doctor::where('username', 'doctor')->exists()) {
            $this->command->info('Doctor already exists, skipping.');
            return;
        }

        Doctor::create([
            'username' => 'doctor',
            'password' => Hash::make('123456'),
            'name'     => 'Dr. Gary Vergara',
        ]);

        $this->command->info('Doctor created: doctor / 123456');
    }
}
