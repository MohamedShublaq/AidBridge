<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('id_number')->unique();
            $table->string('password');
            $table->unsignedTinyInteger('joining_way')->default(User::DEFAULT_WAY);
            $table->foreignId('added_by_provider')->nullable()->constrained('providers')->nullOnDelete();
            $table->foreignId('country_id')->nullable()->constrained('countries')->nullOnDelete();
            $table->string('city');
            $table->string('street');
            $table->string('phone');
            $table->string('id_photo')->nullable();
            $table->unsignedTinyInteger('gender');
            $table->unsignedTinyInteger('age');
            $table->unsignedTinyInteger('marital_status');
            $table->unsignedTinyInteger('childrens')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}