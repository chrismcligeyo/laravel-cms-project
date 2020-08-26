<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->index()->default(0);
            $table->integer('category_id')->unsigned()->index()->default(0);
            $table->integer('photo_id')->unsigned()->index()->default(0);
            $table->string('title');
            $table->text('body');

            $table->timestamps();

            //delete related models. delete users content when user is deleted as well
            //the below methods enable you to delete a user together with photo and post at once.
            //if you delete user, it will delete all user details, i.e user posts, user photo, etc.

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); //onDelete('cascade') means cascade down deleting everything. delete user, user post, user photo etc
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
        Schema::dropIfExists('posts');
    }
}
