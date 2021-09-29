<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGiftCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gift_campaigns', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('campaign_status_id')->constrained();
            $table->foreignId('user_id')->nullable();
            $table->date('dispatch_date');
            $table->date('delivery_date');
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
        Schema::dropIfExists('gift_campaigns');
    }
}
