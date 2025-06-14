<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
        {
            Schema::table('clubs', function (Blueprint $table) {
                $table->string('allowed_classroom')->nullable(); // เช่น "ม.6/1"
            });
        }

        public function down()
        {
            Schema::table('clubs', function (Blueprint $table) {
                $table->dropColumn('allowed_classroom');
            });
        }

};
