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
        Schema::create('component_sofa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBiginteger('sofas_id')->unsigned();
            $table->unsignedBiginteger('components_id')->unsigned();

            $table->foreign('sofas_id')->references('id')
                ->on('sofas')->onDelete('cascade');
            $table->foreign('components_id')->references('id')
                ->on('components')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('component_sofa');
    }
};
