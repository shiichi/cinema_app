<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{

                Schema::create('positions', function(Blueprint $table)
                {
                        $table->increments('id');
                        $table->string('position');
                        $table->text('details')->nullable();
                        $table->timestamps();
                });

		Schema::create('people', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name');
			$table->string('yomi')->nullable();
                        $table->string('sub_name')->nullable();
                        $table->string('born')->nullable();
                        $table->date('birth')->nullable();
                        $table->date('deth')->nullable();
			$table->timestamps();
		});

		Schema::create('movie_person', function(Blueprint $table)
                {
			$table->integer('movie_id')->unsigned()->index();
			$table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');

                        $table->integer('person_id')->unsigned()->index();
                        $table->foreign('person_id')->references('id')->on('people')->onDelete('cascade');
			
			$table->integer('position_id')->unsigned()->index();
                        $table->foreign('position_id')->references('id')->on('positions')->onDelete('cascade');

			$table->tinyInteger('priority');
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
		Schema::drop('positions');

		Schema::drop('people');
                Schema::drop('movie_person');
	}

}
