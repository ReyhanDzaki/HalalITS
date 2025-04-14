<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDescriptionToPhotosTable extends Migration
{
    public function up()
    {
        // Create the photos table if it does not exist
        if (!Schema::hasTable('photos')) {
            Schema::create('photos', function (Blueprint $table) {
                $table->id(); // Primary key
                $table->string('description')->nullable(); // Description column
                $table->string('photos')->nullable(); // photos column
                $table->unsignedBigInteger('umkm_id'); // Foreign key column
                $table->timestamps();

                // Foreign key constraint
                $table->foreign('umkm_id')->references('id')->on('umkms')->onDelete('cascade');
            });
        } else {
            // If the table already exists, just add the new columns
            Schema::table('photos', function (Blueprint $table) {
                if (!Schema::hasColumn('photos', 'description')) {
                    $table->string('description')->nullable(); // Add description column
                }
                if (!Schema::hasColumn('photos', 'umkm_id')) {
                    $table->unsignedBigInteger('umkm_id'); // Add foreign key column
                    // Foreign key constraint
                    $table->foreign('umkm_id')->references('id')->on('umkms')->onDelete('cascade');
                }
            });
        }
    }

    public function down()
    {
        Schema::table('photos', function (Blueprint $table) {
            // Remove the foreign key constraint and columns
            if (Schema::hasColumn('photos', 'umkm_id')) {
                $table->dropForeign(['umkm_id']);
                $table->dropColumn('umkm_id');
            }
            if (Schema::hasColumn('photos', 'description')) {
                $table->dropColumn('description');
            }
        });

        // Drop the table if it exists
        if (Schema::hasTable('photos')) {
            Schema::dropIfExists('photos');
        }
    }
}
