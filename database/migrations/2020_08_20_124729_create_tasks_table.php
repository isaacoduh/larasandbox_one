<?php

use App\Task;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('task');
            $table->string('description');
            $table->boolean('done')->default(0);
            $table->timestamps();
        });

        Task::create(['task' => 'Weekend Reading', 'description' => 'Call linkup crew, and setup for work', 'done' => false]);
        Task::create(['task' => 'Late night work', 'description' => 'Finish coding POS API', 'done' => false]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
