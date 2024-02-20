<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            // $table->string('currency');
            // $table->unsignedInteger('kategori_id')->change();
            // $table->foreign('kategori_id')
            //     ->references('kategori_id')
            //     ->on('kategori')
            //     ->onUpdate('restrict')
            //     ->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produks');
    }
    // public function down()
    // {
    //     Schema::table('produks', function (Blueprint $table){
    //         $table->integer('kategori_id')->change();
    //         $table->dropForeign('produks_kategori_id_foreign');
    //     });
    // }
};
