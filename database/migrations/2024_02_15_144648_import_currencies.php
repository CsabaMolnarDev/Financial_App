<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
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
