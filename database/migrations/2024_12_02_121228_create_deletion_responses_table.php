<?php

use App\Models\DeletionResponse;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeletionResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deletion_responses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('deletion_request_id')->constrained('deletion_requests')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('admin_id')->constrained('admins')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedTinyInteger('status');
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
        Schema::dropIfExists('deletion_responses');
    }
}