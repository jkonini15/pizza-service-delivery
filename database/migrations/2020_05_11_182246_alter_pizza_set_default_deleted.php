<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterPizzaSetDefaultDeleted extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('pizzas', function (Blueprint $table) {
            $table->dropColumn('deleted_at');
        });
        Schema::table('pizzas', function (Blueprint $table) {
            $table->timestamp('deleted_at')->default(null);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
