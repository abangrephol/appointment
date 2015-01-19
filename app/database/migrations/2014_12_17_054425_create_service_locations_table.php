<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateServiceLocationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('service_locations', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('name',60);
            $table->text('description');
            $table->text('address');
            $table->string('timezone',20);
            $table->string('gmap',50)->nullable();
            $table->tinyInteger('is_active');
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
		Schema::drop('service_locations');
	}

}
