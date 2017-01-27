<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBorrowersTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::create('borrowers', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('user_id');
        $table->foreign('user_id')->references('id')->on('users');
        $table->decimal('money');
        $table->string('purpose');
        $table->text('description');
        $table->decimal('raised');
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
      Schema::dropIfExists('borrowers');
  }
}
