<?php

use App\Booking\RoomStatus;
use App\Booking\RoomType;
use App\Models\Location;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->foreignIdFor(Location::class, 'location_id');
            $table->string('number');
            $table->enum('status', array_column(RoomStatus::cases(), 'name'));
            $table->enum('type', array_column(RoomType::cases(), 'name'));
            $table->boolean('smoke');

            $table->primary([
                'location_id',
                'number',
            ]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
