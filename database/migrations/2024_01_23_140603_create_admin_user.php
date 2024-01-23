<?php

use App\Models\Vendor;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $adminUser = [
            "name" => "Vinicius",
            "email" => env("ADMIN_EMAIL"),
            "telephone" => env("ADMIN_TELEPHONE"),
            "password" => Hash::make(env("ADMIN_PASSWORD")),
            "isAdmin" => 1,
        ];

        Vendor::create($adminUser);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $adminEmail = env("ADMIN_EMAIL");

        // Excluir o usuário administrador pelo email
        Vendor::where('email', $adminEmail)->delete();
    }
};
