<?php

use App\Models\DeletionRequest;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeletionRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deletion_requests', function (Blueprint $table) {
            $table->id();
            $table->morphs('deletable');
            $table->foreignId('requester')->constrained('admins')->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedTinyInteger('status')->default(DeletionRequest::DEFAULT_STATUS);
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
        Schema::dropIfExists('deletion_requests');
    }
}