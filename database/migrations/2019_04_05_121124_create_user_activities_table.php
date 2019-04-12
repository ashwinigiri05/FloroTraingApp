<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->unsignedInteger('user_id')->foreign();
            $table->string('entity_type')->comment('polymorphic relations (models, i.e. users table)');
            $table->uuid('entity_id')->comment('entity model reference id.');
            $table->string('old_value');
            $table->string('modified_value');
            $table->string('modified_by')->references('id')->on('users');
            $table->string('column_name')->comment('field name which is modified.');
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
        Schema::dropIfExists('user_activities');
    }
}
