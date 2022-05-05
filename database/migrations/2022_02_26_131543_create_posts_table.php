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
        Schema::create('posts', function (Blueprint $table) {
            $table->id('id');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->string('title');
            $table->text('description');
            $table->longText('images')->nullable();
            $table->unsignedBigInteger('precedent_id')->nullable();
            $table->foreign('precedent_id')->references('id')->on('precedents');
            $table->unsignedBigInteger('cooperation_id')->nullable();
            $table->foreign('cooperation_id')->references('id')->on('cooperations');
            $table->unsignedBigInteger('pmethod_id')->nullable();
            $table->foreign('pmethod_id')->references('id')->on('pmethods');
            $table->unsignedBigInteger('workinghours_id')->nullable();
            $table->foreign('workinghours_id')->references('id')->on('workinghours');
            $table->unsignedBigInteger('working_experience_id')->nullable();
            $table->foreign('working_experience_id')->references('id')->on('working_experiences');
            $table->boolean('insurance')->nullable()->default(false);
            $table->boolean('remote')->nullable()->default(false);
            $table->boolean('military_service')->nullable()->default(false);
            $table->string('view')->default(0);
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('posts');
    }
};
