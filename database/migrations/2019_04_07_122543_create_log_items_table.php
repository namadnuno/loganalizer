<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_items', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('level');
            $table->text('message')->nullable();
            $table->text('context')->nullable();
            $table->datetime('datetime');
            $table->unsignedInteger('site_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('log_items');
    }
}
