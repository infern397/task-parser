<?php

use App\Models\Companies\Company;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTokensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tokens', function (Blueprint $table) {
            $table->id();
            $table->foreignId('account_id')->constrained();
            $table->foreignId('api_service_id')->constrained();
            $table->foreignId('token_type_id')->constrained();
            $table->string('token');
            $table->unique(['token', 'token_type_id', 'api_service_id']);
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
        Schema::dropIfExists('tokens');
    }
}
