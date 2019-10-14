<?php
use App\User;
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
            $table->string('username')->unique();
            $table->text('address')->nullable();
            $table->text('bio')->nullable();
               $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->nullable();
            $table->string('image_profile')->nullable();
            $table->rememberToken();
            $table->integer('verified')->default(User::UNVERIFIED_USER);
            $table->string('verification_token')->nullable();
            $table->integer('active')->default(User::UNVERIFIED_USER);
            $table->string('admin')->default(User::REGULAR_USER);
            $table->string('player_id')->nullable();
            $table->integer('created_by')->nullable();
            $table->timestamps();
            $table->integer('role_id')->unsigned();
            $table->integer('team_id')->unsigned()->index();
            $table->integer('country_id')->unsigned()->index();

            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('team_id')->references('id')->on('teams');

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
