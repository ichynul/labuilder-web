<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLabuilderTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attachments', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id', false, true)->index('admin_id');
            $table->integer('user_id', false, true)->index('user_id');
            $table->string('name', 100);
            $table->string('mime', 55);
            $table->string('suffix', 10)->index('suffix');
            $table->double('size', 10, 2, true);
            $table->string('sha1', 100);
            $table->string('storage', 100)->index('storage');
            $table->string('url', 255);
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
        Schema::dropIfExists('attachments');
    }
}
