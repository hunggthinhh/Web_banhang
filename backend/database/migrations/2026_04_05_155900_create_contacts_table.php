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
        Schema::create('contacts', function (Blueprint $label) {
            $label->id();
            $label->string('fullname');
            $label->string('email');
            $label->string('phone')->nullable();
            $label->string('subject')->nullable();
            $label->text('message');
            $label->boolean('is_read')->default(false);
            $label->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
