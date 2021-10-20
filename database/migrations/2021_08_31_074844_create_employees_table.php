<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('id_emp')->unique();
            $table->string('name_th');           
            $table->string('name_en');            
            $table->string('nickname')->nullable();
            $table->string('ipphone')->nullable();
            $table->string('mobile');
            $table->string('email')->unique();
            $table->string('position');
            $table->string('team');
            $table->string('department');
            $table->string('group')->nullable();
            $table->string('location')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('employees');
    }
}
