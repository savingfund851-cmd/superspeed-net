<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('label')->nullable();
            $table->string('type')->default('text');
            $table->timestamps();
        });

        // Seed default settings
        DB::table('site_settings')->insert([
            ['key' => 'site_name',       'value' => 'SuperSpeed Net', 'label' => 'Site Name',         'type' => 'text',   'created_at' => now(), 'updated_at' => now()],
            ['key' => 'site_email',      'value' => 'info@superspeed.net', 'label' => 'Contact Email', 'type' => 'text',  'created_at' => now(), 'updated_at' => now()],
            ['key' => 'site_phone',      'value' => '',    'label' => 'Contact Phone',    'type' => 'text',   'created_at' => now(), 'updated_at' => now()],
            ['key' => 'site_address',    'value' => '',    'label' => 'Office Address',   'type' => 'textarea', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
