<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        media_type: 0-foto,1-video
        Schema::create('media', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\Note::class)
                ->nullable()
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            $table->string('title')->nullable();

            $table->string('description')->nullable();

            $table->integer('media_type')
                ->nullable()
                ->default( 0
                );

            $table->softDeletes();

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
        Schema::dropIfExists('media');
    }
};
