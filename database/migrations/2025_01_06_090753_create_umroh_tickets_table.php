<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('umroh_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('passport_number')->nullable();
            $table->string('package');
            $table->text('description')->nullable();
            $table->decimal('price', 12, 2)->default(0);
            $table->integer('quota')->default(0);
            $table->date('departure_date');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('umroh_tickets');
    }
};
