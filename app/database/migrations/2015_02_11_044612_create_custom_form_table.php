<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomFormTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('custom_form', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name',100);
            $table->enum('type',array('textfield','text','radio','checkbox','date','list'));
            $table->boolean('requirement');
            $table->text('custom_value')->nullable();
            $table->integer('min_length')->nullable();
            $table->integer('max_length')->nullable();
            $table->integer('subscription_id')->unsigned();
            $table->foreign('subscription_id')
                ->references('id')->on('subscriptions');
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
		Schema::drop('custom_form');
	}

}
