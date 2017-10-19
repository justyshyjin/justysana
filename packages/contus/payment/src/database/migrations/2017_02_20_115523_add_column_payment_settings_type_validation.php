<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class AddColumnPaymentSettingsTypeValidation extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table ( 'payment_settings', function (Blueprint $table) {
            $table->string ( 'validation' )->after ( 'value' );
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table ( 'payment_settings', function (Blueprint $table) {
            $table->dropColumn ( 'validation' );
        } );
    }
}