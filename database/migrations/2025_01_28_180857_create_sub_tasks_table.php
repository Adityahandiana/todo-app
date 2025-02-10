<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('sub_tasks', function (Blueprint $table) {
            $table->id(); // auto increment ID
            $table->unsignedBigInteger('task_id'); // Foreign key untuk task
            $table->foreign('task_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->text('description');
            $table->boolean('completed')->default(false);
            $table->timestamps();
        });
        
        
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_tasks');
    }
};
