<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email')->unique();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('avatar')->nullable();
            $table->timestamps(); // Menambahkan created_at dan updated_at secara otomatis
            $table->softDeletes(); // Menambahkan deleted_at untuk soft delete
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}
