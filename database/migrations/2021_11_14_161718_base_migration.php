<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BaseMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * Table users
         */
        Schema::create('users', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            $table->string('surname');
            $table->string('email');
            $table->string('password')->nullable();
            $table->string('role')->default('admin');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable()->useCurrentOnUpdate();
        });

        /**
         * Table users
         */
        Schema::create('places', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            $table->string('address');
            $table->time('working_hours_start');
            $table->time('working_hours_end');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable()->useCurrentOnUpdate();
        });

        Schema::create('customers', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('name');
            $table->string('surname');
            $table->string('age')->nullable();
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable()->useCurrentOnUpdate();
        });

        Schema::create('customers_places', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->float('spend_money');
            $table->dateTime('created_at')->useCurrent();
            $table->dateTime('updated_at')->nullable()->useCurrentOnUpdate();
        });


        /*
        |--------------------------------------------------------------------------
        | Foreign keys
        |--------------------------------------------------------------------------
        */

        /**
         * Foreign keys clients_places
         */
        Schema::table('customers_places', function (Blueprint $table) {
            $table->after('id', function ($table) {
                $table->foreignId('customer_id')->constrained('customerss')->onDelete('cascade');
            });
            $table->after('customers_id', function ($table) {
                $table->foreignId('place_id')->constrained('places')->onDelete('cascade');
            });
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function(Blueprint $table) {
            $table->dropForeign(['place_id']);
        });

        Schema::table('clients_places', function(Blueprint $table) {
            $table->dropForeign(['client_id', 'place_id']);
        });

        Schema::drop('users');
        Schema::drop('places');
        Schema::drop('customers');
        Schema::drop('customers_places');

    }
}
