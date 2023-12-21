<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Traits\HasRoles;

class DatabaseSeeder extends Seeder
{

    use HasRoles;
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $admin = Admin::create([

            "username" => "Ameer",
            "password" => Hash::make("123456"),
        ]);
        $admin->assignRole("admin");
    }
}
