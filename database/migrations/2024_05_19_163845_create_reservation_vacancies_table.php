<?php

use App\Location\Infrastructure\Model\Eloquent\LocationVacancyEntity;
use App\Reservation\Infrastructure\Model\Eloquent\ReservationEntity;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservation_vacancies', function (Blueprint $table) {
            $table->foreignIdFor(ReservationEntity::class, 'reservation_id');
            $table->foreignIdFor(LocationVacancyEntity::class, 'vacancy_id');
            $table->unsignedTinyInteger('persons');

            $table->primary([
                'reservation_id',
                'vacancy_id',
            ]);

            $table->foreign('reservation_id')->references('id')->on('reservations');
            $table->foreign('vacancy_id')->references('id')->on('vacancies');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservation_vacancies');
    }
};
