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
        Schema::table('users', function (Blueprint $table) {
            $table->string('email')->nullable()->change();
            $table->string('login_id')->nullable()->unique()->after('id');
        });

        // Populate login_id for existing users
        \Illuminate\Support\Facades\DB::statement('UPDATE users SET login_id = COALESCE(phone, email)');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('login_id');
            // Assuming email was required originally
            $table->string('email')->nullable(false)->change();
        });
    }
};
