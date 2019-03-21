<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMailinglistTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailing_list_topics', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('mailing_list_list_id');
            $table->bigInteger('mailing_list_author_id')->nullable();
            $table->string('topic');
            $table->timestamps();
        });
    }
}
