<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('title');
            $table->integer('type', 2);
            $table->integer('status', 2);
            $table->string('amount', 20);
            $table->string('accepted_amount', 20);
            $table->integer('percentage', 3);
            $table->string('return_amount', 20);
            $table->integer('return_month', 4);
            $table->string('start_date', 10);
             $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('loan_docs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('loan_id');
            $table->longText('file');
            $table->integer('type', 2);
             $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('loan_repayment', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('loan_id');
            $table->string('amount', 20);
            $table->string('date', 10);
             $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('financials');
    }
};
