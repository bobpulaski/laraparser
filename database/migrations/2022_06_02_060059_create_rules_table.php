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
        Schema::create('rules', function (Blueprint $table) {
            $table->id();

            $table->foreignId('chapter_id')->constrained ()->onDelete ('cascade');
            $table->foreignId('project_id')->constrained ()->onDelete ('cascade');
            $table->foreignId('user_id')->constrained ()->onDelete ('cascade');

            $table->string('header_name');
            $table->string('rule_left');
            $table->string('rule_right');

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
        Schema::dropIfExists('rules');
    }
};
