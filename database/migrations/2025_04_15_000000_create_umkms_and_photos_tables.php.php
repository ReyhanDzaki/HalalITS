<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUmkmsAndPhotosTables extends Migration
{
    public function up()
    {
        // Create the umkms table
        if (!Schema::hasTable('umkms')) {
            Schema::create('umkms', function (Blueprint $table) {
                $table->id(); // Primary key
                $table->string('no_umkm')->unique(); // Unique UMKM number
                $table->string('nama_pemilik'); // Owner's name
                $table->string('nama_umkm'); // UMKM name
                $table->string('nama_produk'); // Product name
                $table->string('tipe_binaan'); // Type of building
                $table->string('alamat'); // Address
                $table->string('desa'); // Village
                $table->string('kecamatan'); // Subdistrict
                $table->string('kota'); // City
                $table->string('status'); // Status of UMKM
                $table->string('image')->nullable(); // Image URL or path
                $table->string('no_wa')->nullable(); // WhatsApp number
                $table->string('email')->nullable(); // Email address
                $table->string('instagram')->nullable(); // Instagram handle
                $table->string('facebook')->nullable(); // Facebook handle
                $table->string('bpom')->nullable(); // BPOM certificate
                $table->string('pirt')->nullable(); // PIRT certificate
                $table->string('google_map')->nullable(); // Google Maps link
                $table->string('tokopedia')->nullable(); // Tokopedia URL
                $table->string('shopee')->nullable(); // Shopee URL
                $table->string('bukalapak')->nullable(); // Bukalapak URL
                $table->string('website')->nullable(); // Website URL
                $table->string('video')->nullable(); // Video link
                $table->string('sertifikat_halal')->nullable(); // Halal certificate
                $table->string('produkdesa')->nullable(); // Desa product
                $table->unsignedBigInteger('user_id'); // User ID
                $table->string('dosen')->nullable(); // Lecturer name
                $table->unsignedBigInteger('cities_id'); // City ID
                $table->timestamp('status_date')->nullable(); // Date of status update
                $table->decimal('latitude', 10, 7)->nullable(); // Latitude
                $table->decimal('longitude', 10, 7)->nullable(); // Longitude
                $table->string('plus_code')->nullable(); // Plus code
                $table->string('google_maps')->nullable(); // Google Maps code
                $table->timestamps(); // Created and updated timestamps
            });
        }

        // Create the photos table if it does not exist
        if (!Schema::hasTable('photos')) {

            Schema::create('photos', function (Blueprint $table) {
                $table->id(); // Primary key
                $table->string('description')->nullable(); // Description column
                $table->string('photos')->nullable(); // Photos column
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
        // Drop the photos table if it exists
        if (Schema::hasTable('photos')) {
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
            Schema::dropIfExists('photos');
        }

        // Drop the umkms table if it exists
        if (Schema::hasTable('umkms')) {
            Schema::dropIfExists('umkms');
        }
    }
}
