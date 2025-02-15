<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToSubscriptionLogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('subscriptionLog', function (Blueprint $table) {
            //
            $table->string('status')->default('PENDING')->after('action');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subscriptionLog', function (Blueprint $table) {
            //
            $table->dropColumn('status');
        });
    }
}
