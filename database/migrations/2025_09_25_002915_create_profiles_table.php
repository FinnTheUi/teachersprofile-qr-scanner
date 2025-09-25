<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('office_id')->constrained()->onDelete('cascade');
            $table->string('specialization');
            $table->text('educational_background');
            $table->text('researches')->nullable();
            $table->text('subjects_taught');
            $table->string('contact_number');
            $table->string('course');
            $table->string('profile_picture')->nullable();
            $table->json('social_links')->nullable(); // Stores FB, LinkedIn, etc.
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
