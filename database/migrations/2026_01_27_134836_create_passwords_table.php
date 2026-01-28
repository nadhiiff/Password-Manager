<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Create the passwords table
        Schema::create('passwords', function (Blueprint $table) {
            $table->id(); // Primary Key
            // We use nullable() for user_id for now as we haven't set up auth fully yet, 
            // but in a real app this should be required and constrained.
            // For this specific request, I will assume we might want to link it later 
            // or just keep it simple. Let's make it nullable for safety if no auth is enforced yet.
            // However, the previous code had foreignId('user_id')->constrained()->onDelete('cascade');
            // If the user hasn't run migrations for users table yet (standard in laravel), this works.
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade'); 
            
            $table->string('website_name'); // Name of the website
            $table->string('username'); // Username for the website
            $table->text('password'); // Encrypted password
            $table->timestamps(); // Created at and Updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop the table if it exists
        Schema::dropIfExists('passwords');
    }
};