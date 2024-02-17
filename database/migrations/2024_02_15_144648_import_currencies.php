<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('currencies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code');
            $table->string('symbol');
        });

        $databasePath = database_path();
        $sqlFilePath = $databasePath . '/SQL_file/Currencies.sql';
        $sqlContent = file_get_contents($sqlFilePath);
        DB::unprepared($sqlContent);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
