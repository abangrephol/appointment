<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAppointmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *appointments
     * - customer id
     * - confirmation number
     * - note
     * - price
     * - price tax
     * - price deposit
     * - price total

     * @return void
	 */
	public function up()
	{
		Schema::create('appointments', function(Blueprint $table)
		{
			$table->bigIncrements('id');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')
                ->references('id')->on('customers');
            $table->string('confirmation_number')->unique();
            $table->text('note')->nullable();
            $table->double('price');
            $table->double('price_tax');
            $table->double('price_deposit');
            $table->double('price_total');
            $table->tinyInteger('status')->default(0);
            $table->softDeletes();
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
		Schema::drop('appointments');
	}

}
