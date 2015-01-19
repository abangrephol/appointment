<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEmployeesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('employees', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('first',50);
            $table->string('last',50);
            $table->string('title',30)->nullable();
            $table->string('phone',30)->nullable();
            $table->string('phone_ext',6)->nullable();
            $table->string('email')->nullable();
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
		Schema::drop('employees');
	}

}
