<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
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
        if (!Schema::hasTable('tbl_user')) {
            Schema::create('tbl_user', function (Blueprint $table) {
                $table->string('username', 100)->primary();
                $table->string('name');
                $table->string('email')->unique();
                $table->timestamp('email_verified_at')->nullable();
                $table->string('password');
                $table->dateTime('login_at')->nullable();
                $table->enum('level', ['Rpt', 'Edt', 'Adm'])->default('Rpt')->comment('Rpt : Reporter, Edt : Editor, Adm : Admin');
                $table->enum('status', ['0', '1'])->default('1')->comment('Status Active');
                $table->rememberToken();
                $table->timestamps();
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tbl_user');
    }
}
