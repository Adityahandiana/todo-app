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
        Schema::table('sub_tasks', function (Blueprint $table) {
            $table->boolean('completed')->default(false)->change();  // Menyesuaikan kolom jika perlu
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('sub_tasks', function (Blueprint $table) {
            $table->dropColumn('completed'); // Menghapus kolom 'completed'
        });
    }
};
