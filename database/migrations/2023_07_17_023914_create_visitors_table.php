<?php

use App\Enums\TableEnum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(TableEnum::VISITORS(), function (Blueprint $table) {
            $table->id();
            $table->string("address_ip")->nullable();
            $table->string("browser")->nullable();
            $table->string("operation_system")->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(TableEnum::VISITORS());
    }
}
