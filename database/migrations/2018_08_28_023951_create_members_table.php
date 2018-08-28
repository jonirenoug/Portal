<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->increments('id');
            $table->string('member_name');
            $table->string('first_name');
            $table->string('surname');
            $table->integer('phone');
            $table->string('postal_street_address');
            $table->string('postal_suburb');
            $table->string('postal_state');
            $table->integer('postal_postcode');
            $table->string('postal_country');
            $table->integer('security_code');
            $table->integer('fob_number');
            $table->string('avatar');
            $table->integer('id_user');

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
        Schema::dropIfExists('members');
    }
}
