<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentRepliesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_replies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('comment_id')->unsigned()->index()->default(0);
            $table->integer('is_active')->default(0);
            $table->string('author')->nullable();
            $table->string('photo')->default(0);
            $table->string('email')->nullable();
            $table->text('body');
            $table->timestamps();

            //create constraint such that when you delete a comment you delete its replies as well.
            $table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade');
            //above means foreign key pozt id from this table references the primary key id in posts table so delete together
            //above means foreign key pozt id from this table references the primary key id in posts table so delete together
            //make sure that all foreign keys referencing each other have the same data. i.e if foreign key in posts table hasbeen refrenced by comment, then   $table->integer('post_id')->unsigned()->index()->default(0); and   $table->integer('user_id')->unsigned()->index()->default(0); $table->integer('comment_id')->unsigned()->index()->default(0); should all have unsigned()->index()->default(0). prevents migration errors
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comment_replies');
    }
}
