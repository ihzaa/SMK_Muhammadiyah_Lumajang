<?php

use App\Models\Master\Facility;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilityImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_images', function (Blueprint $table) {
            // MUST HAVE
            $table->id();
            // MUST HAVE

            // OPTIONAL
            $table->foreignId('facility_id')->constrained(Facility::getTableName());
            $table->text('img_path');
            // OPTIONAL

            // MUST HAVE
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by');
            $table->unsignedBigInteger('deleted_by');
            $table->unsignedBigInteger('restored_by');
            $table->timestamps();
            $table->softDeletes();
            $table->dateTime('restored_at')->nullable();
            // MUST HAVE
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('facility_images');
    }
}
