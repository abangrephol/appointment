<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function(Blueprint $table)
		{
			$table->increments('id');
            $table->string('first',50);
            $table->string('last',50);
            $table->string('email');
            $table->string('username',50)->unique();
            $table->string('password',128);
            $table->integer('subscription_id')->unsigned()->nullable();
            $table->foreign('subscription_id')
                ->references('id')->on('subscriptions');
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
		Schema::drop('users');
	}

}
