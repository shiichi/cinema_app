<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('movies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title');
			$table->string('yomi')->nullable();
			$table->string('ori_title')->nullable();
			$table->integer('country_id')->unsigned();
			$table->smallInteger('produced')->nullable();
			$table->date('released')->nullable();
			$table->smallInteger('runtime')->nullable();
			$table->timestamps();

			$table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('movies');
	}

}
