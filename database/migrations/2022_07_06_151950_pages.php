<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Pages extends Migration {

    /**
     * @author Pramod Kushwaha
     * 
     * Run the migration for create pages table 
     *
     * @return void
     */
    public function up() {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id')->nullable(true);
            $table->string('slug')->unique();
            $table->string('title');
            $table->string('content');
            $table->timestamps();
        });
    }

    /**
     * @author Pramod Kushwaha
     * 
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('pages');
    }

}
