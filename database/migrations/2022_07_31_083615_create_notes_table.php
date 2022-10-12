<?php

use App\Models\Domain;
use App\Models\SubCategory;
use App\Models\Team;
use App\Models\User;
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
            $table->text('body')
                //                ->fulltext()
                ->nullable();

            $table->integer('rating_popularity')->default(0);
            

            $table->json('html_block')->nullable();
            // a block {
            //            'block_header':'',
            //            'block_code_html':'',
            //            'block_footer':''
            //        }
            //}
            //            blocks=[block1,block2,...]
            $table->json('links')->nullable();
            //            a Link ={
            //            'description':'',
            //            'link':''}
            // links =[link1,...,link23]
            //
            $table->foreignIdFor(SubCategory::class)
                ->constrained()
                ->cascadeOnUpdate();

            //            $table->bigInteger('created_by_user');

            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Team::class)->nullable();

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
