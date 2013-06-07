<?php

class Create_Blocks {

	/**
	 * Make changes to the database.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('blocks', function($table) {
            $table->increments('id');
            $table->string('url', 128);
            $table->text('block');
        });
	}

	/**
	 * Revert the changes to the database.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::drop('blocks');
	}

}