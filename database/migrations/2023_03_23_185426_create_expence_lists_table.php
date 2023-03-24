<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpenceListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expence_lists', function (Blueprint $table) {
            $table->id();
            $table->foreignId('expence_book_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->double('amount')->nullable();
            $table->string('account_details')->nullable();
            $table->string('remark')->nullable();
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
        Schema::dropIfExists('expence_lists');
    }
}
