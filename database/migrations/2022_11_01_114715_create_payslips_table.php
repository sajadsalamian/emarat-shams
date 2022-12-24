<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payslips', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('personal_code')->comment('کد پرسنلی');
            $table->string('title')->comment('عنوان');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });

        Schema::create('payslips_details', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('payslip_id')->comment('آیدی فیش');
            $table->string('monthly_salary')->comment('حقوق ماهیانه');
            $table->string('ayelemandi')->comment('حق عائله مندی');
            $table->string('reward')->comment('پاداش');
            $table->string('insurance_earn')->comment('حق بیمه');
            $table->string('sum_of_earn')->comment('کل حقوق و مزایا');
            $table->string('insurance_deduction')->comment('حق بیمه سهم کارمند');
            $table->string('loan_deduction')->comment('کسر وام');
            $table->string('mosaede_deduction')->comment('کسر مساعده');
            $table->string('panelty')->comment('جریمه');
            $table->string('sum_of_deduction')->comment('جمع کسورات');
            $table->string('total_earn')->comment('خالص قابل پرداخت');
            $table->longText('payslip_document')->comment('فیش واریزی');
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
        Schema::dropIfExists('payslips');
    }
};
