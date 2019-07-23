<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStructureUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('structure_user', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('structure_id');
            $table->unsignedInteger('user_id');
            $table->foreign('structure_id')->on('structures')
                        ->references('id')
                        ->onUpdate('cascade')
                        ->onDelete('cascade');

                        $table->foreign('user_id')->on('users')
                        ->references('id')
                        ->onUpdate('cascade')
                        ->onDelete('cascade');
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
        Schema::dropIfExists('structure_user');
    }
}
