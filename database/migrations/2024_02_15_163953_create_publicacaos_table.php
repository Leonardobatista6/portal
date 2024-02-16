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
        Schema::create('publicacaos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->integer('categoria')->nullable();
            $table->text('titulo')->nullable();
            $table->longText('descricao')->nullable();


            $table->foreign('user_id')->references('id')->on('users');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('publicacaos',function (Blueprint $table){
            $table->dropForeign('publucacoes_user_id_foreign');
            $table->dropColumn('user_id');
        });
        Schema::dropIfExists('publicacaos');
    }
};
