<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('标题');
            $table->string('author')->nullable()->comment('作者');
            $table->string('description')->nullable()->comment('文章简介');
            $table->unsignedBigInteger('category_id')->comment('所属分类')->nullable();
            $table->longText('content')->comment('内容');
            $table->string('image')->nullable();
            $table->unsignedInteger('views')->default(0)->comment('浏览量');
            $table->boolean('active')->default(1)->comment('是否显示');
            $table->boolean('commentable')->default(1)->comment('开启评论');
            $table->boolean('recommended')->default(0)->comment('推荐/置顶');
            $table->unsignedInteger('likes')->default(0)->comment('点赞数');
            $table->string('tags')->nullable();
            $table->integer('sort_order')->nullable();
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
        Schema::dropIfExists('articles');
    }
}
