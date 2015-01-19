<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCustomersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('customers', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('first',50);
            $table->string('last',50);
            $table->string('email');
            $table->string('address_1',80);
            $table->string('address_2',80)->nullable();
            $table->string('zip',10);
            $table->string('username',50)->unique()->nullable();;
            $table->string('password',128)->nullable();;
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
		Schema::drop('customers');
	}

}
