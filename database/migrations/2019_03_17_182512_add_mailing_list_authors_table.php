<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMailinglistAuthorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailing_list_authors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email');
            $table->string('display_name');
            $table->timestamps();
        });
    }
}
