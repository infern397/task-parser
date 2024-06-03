<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApiServiceTokenType extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('api_service_token_type', function (Blueprint $table) {
            $table->id();
            $table->foreignId('api_service_id')->constrained('api_services')->onDelete('cascade');
            $table->foreignId('token_type_id')->constrained('token_types')->onDelete('cascade');
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
        Schema::dropIfExists('api_service_token_type');
    }
}
