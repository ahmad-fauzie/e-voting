<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbacksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedbacks', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user')->unsigned();
            $table->string('login');
            $table->string('daftar');
            $table->string('reset');
            $table->string('dashboard');
            $table->string('siswa');
            $table->string('kandidat');
            $table->string('voting');
            $table->string('qna');
            $table->string('hasil');
            $table->string('jadwal');
            $table->string('profile');
            $table->string('rating');
            $table->text('feedback');
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
        Schema::dropIfExists('feedbacks');
    }
}
