<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServicesTable extends Migration {

	/**
	 * Run the migrations.
     *
	 *
     * services
     * -	name
     * -	description
     * -	price
     * -	duration
     * -	interval
     * -	capacity

     * @return void
	 */
	public function up()
	{
		Schema::create('services', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->double('price');
            $table->integer('duration')->length(3);
            $table->integer('interval')->length(3);
            $table->integer('capacity')->length(2);
            $table->tinyInteger('is_active')->default(1);
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
		Schema::drop('services');
	}

}
