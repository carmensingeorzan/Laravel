<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPhoneTermsAndTermsAcceptedDatetimeColumnsOnUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {

        Schema::table('users', function (Blueprint $table) {
            $table->integer('phone')->after('password');
            $table->boolean('terms')->after('phone')->default('0');
            $table->timestamp('terms_accepted_datetime')->after('terms')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'phone')) {
                $table->dropColumn('phone');
            }
            if (Schema::hasColumn('users', 'terms')) {
                $table->dropColumn('terms');
            }
            if (Schema::hasColumn('users', 'terms_accepted_datetime')) {
                $table->dropColumn('terms_accepted_datetime');
            }
        });
    }

}
