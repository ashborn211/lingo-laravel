<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_scores_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateScoresTable extends Migration
{
    public function up()
    {
        Schema::create('scores', function (Blueprint $table) {
            $table->id(); // This automatically makes the `id` column an auto-incrementing primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->integer('guesses')->nullable(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('scores');
    }
}
