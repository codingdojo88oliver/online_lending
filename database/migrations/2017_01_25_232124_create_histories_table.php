<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriesTable extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
      Schema::create('histories', function (Blueprint $table) {
        $table->increments('id');
        $table->integer('borrower_id');
        $table->foreign('borrower_id')->references('id')->on('borrowers');
        $table->integer('lender_id');
        $table->foreign('lender_id')->references('id')->on('lenders');
        $table->decimal('amount');
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
      Schema::dropIfExists('histories');
  }
}
