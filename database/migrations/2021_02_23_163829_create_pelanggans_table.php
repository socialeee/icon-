<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePelanggansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pelanggans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('activator_id')->nullable()->constrained('users');
            $table->string('nomor_so');
            $table->string('nama');
            $table->text('alamat');
            $table->enum('status', ['AKTIF', 'NONAKTIF'])->default('NONAKTIF');
            $table->json('file1')->nullable();
            $table->string('ptl');
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
        Schema::dropIfExists('pelanggans');
    }
}
