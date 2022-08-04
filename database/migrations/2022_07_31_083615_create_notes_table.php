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
        Schema::create('notes', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
//            blocks used for code blocks(js php html...
//            for any other kind of content fiel is used
            $table->text('content')
                ->nullable();
            $table->json('blocks')->nullable();
// a block {
//            'introduction':'',
//            'code_html':'',
//            'conclusion':''
//        }
//}
//            blocks=[block1,block2,...]
            $table->json('links')->nullable();
//            a Link ={
//            'description':'',
//            'link':''}
// links =[link1,...,link23]
//
            $table->foreignId('category_id')
                ->constrained()
                ->cascadeOnUpdate();

            $table->bigInteger('created_by_user');


            $table->timestamps();

            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notes');
    }
};
