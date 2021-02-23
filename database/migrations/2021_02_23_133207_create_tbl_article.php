<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTblArticle extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tbl_article')) {
            Schema::create('tbl_article', function (Blueprint $table) {
                $table->id('id_article');
                $table->string('title', 250);
                $table->text('body');
                $table->string('created_by', 100);
                $table->string('published_by', 100);
                $table->dateTime('published_date');
                $table->integer('page_view');
                $table->enum('published', ['0', '1'])->default('0')->comment('Status Published, 0 : Unpublish, 1 : Published');
                $table->enum('status', ['0', '1'])->default('1')->comment('Status Active');
                $table->timestamps();
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_article');
    }
}
