<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
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
        Schema::create('sponsers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('type', ['personal', 'institution']);
            $table->string('password', 50)->nullable();
            $table->string('email')->unique();
            $table->foreignId('country_id')->constrained('countries')->cascadeOnDelete();
            $table->string('address', 255);
            $table->string('responsible_name')->nullable();
            $table->string('phone');
            $table->string('phone2')->nullable();
            $table->foreignId('city_id')->constrained('cities')->nullOnDelete();
            $table->unsignedInteger('telephone')->nullable();
            $table->string('nationality')->nullable();
            $table->enum('ident_type',['identification', 'passport'])->nullable();
            $table->unsignedInteger('identifier')->nullable();
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
        Schema::dropIfExists('sponsers');
    }
};
