<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMailinglistMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailing_list_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('mailing_list_topic_id');
            $table->bigInteger('mailing_list_author_id')->nullable();
            $table->string('hash'); /* uniquely identify a message */
            $table->longText('raw')->nullable();    /* Full MIME message, including headers */
            $table->longText('content');
            $table->timestamps();
        });
    }
}
