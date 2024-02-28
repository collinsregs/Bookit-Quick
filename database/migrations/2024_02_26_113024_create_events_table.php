<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->bigInteger('event_Id')->unique();
            $table->string('event_Name');
            $table->date('event_Date');
            $table->string('event_Location');
            $table->text('description');
            $table->string('event_category');
            $table->integer('max_Attendees');
            $table->integer('Regular_ticket_price');
            $table->integer('max_VIP_Attendees');
            $table->decimal('VIP_ticket_price', 8, 2)->nullable();
            $table->string('image')->nullable();
            $table->timestamps();

            $table->primary('event_Id');
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
