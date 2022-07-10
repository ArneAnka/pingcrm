<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('subject_id')->constrained()->onDelete('cascade');
            $table->foreignId('stack_id')->constrained()->onDelete('cascade');
            $table->integer('order')->nullable()->default(0);
            $table->text('description')->nullable();
            $table->boolean('is_info');
            $table->text('source')->nullable();
            $table->string('image')->nullable();
            $table->string('tags')->nullable();
            $table->boolean('flagged')->default(false);
            $table->boolean('enabled')->default(true);
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
        Schema::dropIfExists('questions');
    }
}
