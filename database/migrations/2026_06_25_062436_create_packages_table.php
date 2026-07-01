<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('speed_mbps');
            $table->decimal('price', 10, 2);
            $table->integer('validity_days')->default(30);
            $table->boolean('is_active')->default(true);

            // BTRC Compliance Layer
            $table->decimal('btrc_approved_tariff', 10, 2)->nullable()->comment('Official BTRC approved tariff ceiling');
            $table->string('btrc_approval_number')->nullable()->comment('BTRC regulatory reference ID');

            $table->text('description')->nullable();
            $table->string('features')->nullable()->comment('JSON encoded list of features');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
