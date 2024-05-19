<?php

use App\Models\Room;
use App\Reservation\Application\DTO\ReservationStatus;
use App\User\Infrastructure\Model\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class, 'user_id');
            $table->date('date_in');
            $table->date('date_out');
            $table->enum('status', array_column(ReservationStatus::cases(), 'name'));

            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
