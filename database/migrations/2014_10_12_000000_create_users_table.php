<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name');
            $table->string('prenom');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('employe_id')->nullable();

            $table->boolean('active')->default(true);
            $table->boolean('admin')->default(false);
            $table->boolean('super_admin')->default(false);

            $table->rememberToken();
            $table->timestamps();
        });

            factory(App\User::class)->create([
            'name' => 'Super',
            'prenom' => 'Administrateur',
            'super_admin'=>true,
            'admin'=>true,

            'email' => 'super@gmail.com',
            'password' =>Hash::make('11111')
            ]);

             factory(App\User::class)->create([
            'name' => 'Admin',
            'prenom' => 'Simple',
            'admin'=>true,

            'email' => 'admin@gmail.com',
            'password' =>Hash::make('11111')
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
}
