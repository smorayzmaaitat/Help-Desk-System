<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id(); // Automatically creates an "id" column
            $table->string('message_id')->nullable(); // Unique message identifier
            $table->unsignedBigInteger('sender_id'); // ID of the sender
            $table->unsignedBigInteger('receiver_id'); // ID of the receiver
            $table->text('content')->nullable(); // Message content
            $table->string('image')->nullable(); // Path to an image (optional)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
