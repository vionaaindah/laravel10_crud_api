<?php

namespace App\Models;

// use Illuminate\Database\Migrations\Migration;
// use Illuminate\Database\Schema\Blueprint;
// use Illuminate\Support\Facades\Schema;

// class CreateUsersTable extends Migration
// {
//     public function up()
//     {
//         Schema::create('users', function (Blueprint $table) {
//             $table->id();
//             $table->string('email');
//             $table->string('first_name')->nullable();
//             $table->string('last_name')->nullable();
//             $table->string('avatar')->nullable();
//             $table->date('created_at')->nullable();
//             $table->date('updated_at')->nullable();
//             $table->date('deleted_at')->nullable();
//         });
//     }

//     public function down()
//     {
//         Schema::dropIfExists('users');
//     }
// }

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id', 'email', 'first_name', 'last_name', 'avatar', 'created_at', 'updated_at'
    ];

    protected $dates = ['deleted_at'];
}
