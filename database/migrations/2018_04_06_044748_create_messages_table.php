<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('sms_id');
            //add an index here, since we would be searching by this
            $table->string('messageUUID', 50);
            $table->string('to', 20);
            $table->string('status', 15)->default('queued');
            $table->tinyInteger('units')->nullable();
            $table->decimal('totalRate', 8, 2)->nullable();
            $table->decimal('totalAmount', 8, 2)->nullable();
            $table->string('MCC', 10)->nullable();
            $table->string('MNC', 10)->nullable();
            $table->tinyInteger('errorCode')->nullable();
            $table->string('parentMessageUUID', 50)->nullable();
            $table->string('parentInfo', 10)->nullable();
            $table->timestamps();


            $table->foreign('sms_id')->references('id')->on('sms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('messages', function(Blueprint $table){
            $table->dropForeign(['sms_id']);
        });
        Schema::dropIfExists('messages');
    }
}
