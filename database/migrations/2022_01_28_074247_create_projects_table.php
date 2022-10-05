<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Engineer;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     * ProjectEngineer and Project Inspector, temporary data type is int
     *  - to relate it to Engineers table via engineers.id
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('project_id');
            $table->decimal('amount',15,2);
//            $table->foreignId('project_status_id')->constrained();
            // *************** Classification must be in relation with Classification Table ***************
            $table->text('details')->nullable();
            $table->string('contractor')->nullable();
            // This is Just alternative solution
            $table->unsignedBigInteger('project_inspector_id');
            $table->foreign('project_inspector_id')->references('id')->on('engineers')->onDelete('cascade');
            $table->unsignedBigInteger('project_engineer_id');
            $table->foreign('project_engineer_id')->references('id')->on('engineers')->onDelete('cascade');

            // Project Engineer and Project Inspector must be in-relation to Engineer Table
            $table->date('start_date')->nullable();
            $table->date('original_completion_date')->nullable();
            $table->date('revised_completion_date')->nullable();
            $table->timestamps();

            // *************** Project Images - One to Many ***************
            // Pre-Bid must be in relation to Prebid table - One to Many
            // OpeningOfBids must be in relation to OpeningOfBids table - One to Many
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
