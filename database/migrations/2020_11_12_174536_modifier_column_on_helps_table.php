<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifierColumnOnHelpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advisors', function (Blueprint $table) {
            if (Schema::hasColumn('advisors', 'mentor_id')) {
                $table->bigInteger('mentor_id')->nullable()->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('advisors', function (Blueprint $table) {
            if (Schema::hasColumn('advisors', 'mentor_id')) {
                $table->bigInteger('mentor_id')->change();
            }
        });
    }
}
