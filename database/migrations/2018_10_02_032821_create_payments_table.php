<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('image',255)->nullable();
            $table->tinyInteger('priority')->default(1);
            $table->string('short_name',100)->unique();
            $table->string('no',15)->nullable()->comment('Payment no');
            $table->string('type',15)->nullable()->comment('Agent|Personal');

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
        Schema::dropIfExists('payments');
    }
}
