<?php

use App\Models\Reservation;
use App\Models\Vacancy;
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
            $table->foreignIdFor(Reservation::class, 'reservation_id');
            $table->foreignIdFor(Vacancy::class, 'vacancy_id');
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
