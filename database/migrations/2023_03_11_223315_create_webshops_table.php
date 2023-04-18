<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('webshops', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            // address
            $table->unsignedBigInteger('address_id');
            $table->foreign('address_id')->references('id')->on('addresses');

            // contact details
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('webshops');
    }
};


