<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('company_id');
            $table->integer('category_id');
            $table->string('title');
            $table->string('position');
            $table->string('address');
            $table->string('type'); //part time or full time
            $table->string('roles_responsibilities');
            $table->text('description');
            $table->string('slug'); // change the title into slug
            $table->string('status'); //drafted or live
            $table->date('deadline'); 
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
        Schema::dropIfExists('jobs');
    }
}
