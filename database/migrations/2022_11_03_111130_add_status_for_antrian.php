<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusForAntrian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('antrians', function (Blueprint $table) {

            /**
             * 0 = Menunggu
             * 1 = Sedang Dilayani
             * 2 = Selesai
             * 3 = Tidak Hadir
             * 4 = Lewati
             */
            $table->enum('status',[0,1,2,3,4])->nullable()->default(0); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('antrians', function (Blueprint $table) {
            //
            $table->dropColumn('status');
        });
    }
}
