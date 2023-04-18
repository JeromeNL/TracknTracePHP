<?php

use App\Models\enums\CompanyNames;
use App\Models\enums\DeliveryStatus;
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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->uuid('track_and_trace_code')->index();
            $table->string('delivery_status')->default(DeliveryStatus::Aangemeld->value);
            $table->string('delivery_company')->default(CompanyNames::PostNL->value);
            $table->dateTime('expected_delivery_date');
            $table->dateTime('actual_delivery_date')->nullable();

            // package
            $table->unsignedBigInteger('package_id');
            $table->foreign('package_id')->references('id')->on('packages');

            $table->softDeletes();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
