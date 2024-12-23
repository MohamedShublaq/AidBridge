<?php

use App\Models\NgosDonors;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNgosDonorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ngos_donors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('donor_id')->constrained('donors')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('ngo_id')->constrained('ngos')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedTinyInteger('status')->default(NgosDonors::DEFAULT_STATUS);
            $table->timestamp('rejected_at')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('ngos_donors');
    }
}