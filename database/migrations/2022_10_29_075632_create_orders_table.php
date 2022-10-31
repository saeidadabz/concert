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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->decimal('total-price',3,3);
            $table->decimal('discount',3,3)->nullable();
            $table->decimal('final-price',3,3);
            $table->enum('status',['success','failed','pending','pending-gatway']);
            $table->timestamp('expire-date')->nullable();
            $table->timestamp('verified-at')->nullable();
            $table->string('delivery-email-address');
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
        Schema::dropIfExists('orders');
    }
};
