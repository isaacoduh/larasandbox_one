<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            if(env('DB_CONNECTION') === 'sqlite_testing'){
                $table->text('content')->default('');
                $table->unsignedInteger('user_id')->default(0);
            }else{
                $table->text('content');
                $table->unsignedInteger('user_id');
            }

            // if(env('DB_CONNECTION') !== 'sqlite_testing'){
            //     $table->dropForeign(['blog_post_id']);
            // }
            $table->morphs('commentable');
            $table->softDeletes();
            // $table->unsignedInteger('blog_post_id')->index();
            $table->foreign('user_id')->references('id')->on('users');
            // $table->foreign('blog_post_id')->references('id')->on('blog_posts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
