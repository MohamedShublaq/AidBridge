<?php

use App\Models\AidDistribution;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAidDistributionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aid_distributions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('request_id')->constrained('requests')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('location_id')->constrained('locations')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('distribution_date');
            $table->unsignedTinyInteger('status')->default(AidDistribution::DEFAULT_STATUS);
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
        Schema::dropIfExists('aid_distributions');
    }
}