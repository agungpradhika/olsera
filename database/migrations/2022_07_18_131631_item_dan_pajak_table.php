<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ItemDanPajakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('item', function(Blueprint $kolom){
          $kolom->increments('id');
          $kolom->string('nama');
          $kolom->timestamps();
        });

        Schema::create('pajak', function(Blueprint $kolom){
     
          $kolom->increments('id');
          $kolom->unsignedInteger('item_id')->nullable();
          $kolom->string('nama');
          $kolom->decimal('rate');
          $kolom->timestamps();
        });

        Schema::table('pajak', function(Blueprint $kolom){
          $kolom->foreign('item_id')
                ->references('id')
                ->on('item')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('item');
        Schema::drop('pajak');
    }
}
