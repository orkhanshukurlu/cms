<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('portfolio_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('portfolio_id');
            $table->string('image', 17);
            $table->unique(['portfolio_id', 'image']);
            $table->foreign('portfolio_id')
                ->references('id')
                ->on('portfolio')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
        });
    }

    public function down()
    {
        Schema::dropIfExists('portfolio_photos');
    }
};
