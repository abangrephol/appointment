<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAppointmentServicesTable extends Migration {

	/**
	 * Run the migrations.
	 *
     * appointments service
     * - appointment id
     * - service id
     * - date
     * - time
     * - duration

     *
     * @return void
	 */
	public function up()
	{
		Schema::create('appointment_services', function(Blueprint $table)
		{
			$table->bigIncrements('id');
            $table->bigInteger('appointment_id')->unsigned();
            $table->foreign('appointment_id')
                ->references('id')->on('appointments');
            $table->integer('service_id')->unsigned();
            $table->foreign('service_id')
                ->references('id')->on('services');
            $table->integer('employee_id')
                ->references('id')->on('employees');
            $table->date('date');
            $table->time('time');
            $table->integer('duration')->length(3);
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
		Schema::drop('appointment_services');
	}

}
