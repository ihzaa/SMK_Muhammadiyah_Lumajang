<?php

use App\Models\Master\AboutUs;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutUsImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('about_us_images', function (Blueprint $table) {
            // MUST HAVE
            $table->id();
            // MUST HAVE

            // OPTIONAL
            $table->foreignId('about_us_id')->constrained(AboutUs::getTableName());
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
        Schema::dropIfExists('about_us_images');
    }
}
