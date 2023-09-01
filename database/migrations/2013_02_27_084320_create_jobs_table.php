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
            $table->id();
            $table->string('job_title');
            $table->string('job_unique_id')->default('null');
            $table->string('sharable_link')->default('null');
            $table->string('open_in_link')->default('null');
            $table->boolean('isRead')->default(false);
            $table->boolean('isActive')->default(true);
            $table->boolean('isTnj')->default(true);
            $table->boolean('isTrash')->default(false);
            $table->text('job_description');
            $table->text('qualification'); 
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('email_receiver');
            $table->foreign('location_id')
                  ->references('id')
                  ->on('locations')
                  ->onDelete('cascade');
            $table->foreign('category_id')
                  ->references('id')
                  ->on('job_categories')
                  ->onDelete('cascade');
            $table->foreign('email_receiver')
                  ->references('id')
                  ->on('email_senders')
                  ->onDelete('cascade');
            $table->string('salary');
            $table->string('township');
            $table->text('experiences');
            $table->text('responsibilities');
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
