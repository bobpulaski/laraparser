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
        Schema::create('results', function (Blueprint $table) {
            $table->id();

            $table->foreignId('chapter_id')->constrained ()->onDelete ('cascade');
            $table->foreignId('project_id')->constrained ()->onDelete ('cascade');
            $table->foreignId('user_id')->constrained ()->onDelete ('cascade');

            $table->string('ext_header_name');
            $table->string('ext_result');
            $table->string('url');

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
        Schema::dropIfExists('results');
    }
};
