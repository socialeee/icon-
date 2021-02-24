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
            $table->foreignId('sales_id')->constrained('users');
            $table->foreignId('activator_id')->nullable()->constrained('users');
            $table->string('nama');
            $table->text('alamat');
            $table->enum('status', ['AKTIF', 'NONAKTIF'])->default('NONAKTIF');
            $table->string('file1')->nullable();
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
