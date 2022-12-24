<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('personal_code')->comment('کد پرسنلی')->unique();
            $table->string('phone')->unique();
            $table->string('first_name')->comment('نام');
            $table->string('last_name')->comment('نام خانوادگی');
            $table->integer('role', 3)->comment('سمت');
            $table->string('salary')->comment('حقوق پایه');
            $table->integer('employment_type', 2)->comment('نحوه همکاری');
            $table->string('wedding')->comment('وضعیت تاهل');
            $table->string('email')->nullable()->comment('ایمیل کارکنان');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });

        Schema::create('users_access', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->comment('شناسه کاربر');
            $table->integer('financial');
            $table->integer('time_management')->comment('نام');
            $table->integer('access')->comment('نام خانوادگی');
            $table->integer('project')->comment('حقوق پایه');
            $table->integer('employee')->comment('نحوه همکاری');
            $table->timestamps();
        });

        User::create([
            'personal_code' => 10000,
            'phone' => "1",
            'first_name' => "ادمین",
            'last_name' => "",
            'role' => 0,
            'salari' => "10,000,000",
            'employment_type' => 0,
            'wedding' => "1",
            'email' => "salamian.sajad@gmail.com",
            'password' => Hash::make('test')
        ]);
        User::create([
            'personal_code' => 20000,
            'phone' => "2",
            'first_name' => "مسئول",
            'last_name' => "کارگاه",
            'role' => 1,
            'salari' => "5,000,000",
            'employment_type' => 0,
            'wedding' => "0",
            'email' => "salamian.sajad@gmail.com",
            'password' => Hash::make('test')
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
