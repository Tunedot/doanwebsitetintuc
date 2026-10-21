<?php
use Illuminate\Database\Migrations\Migration; use Illuminate\Database\Schema\Blueprint; use Illuminate\Support\Facades\Schema;
return new class extends Migration {
 function up(){
  Schema::table('users',fn($t)=>$t->string('role')->default('editor'));
  Schema::create('categories',function(Blueprint $t){$t->id();$t->string('name');$t->string('slug')->unique();$t->text('description')->nullable();$t->timestamps();});
  Schema::create('articles',function(Blueprint $t){$t->id();$t->string('title');$t->string('slug')->unique();$t->text('summary')->nullable();$t->longText('content');$t->string('image')->nullable();
   $t->foreignId('category_id')->constrained();$t->foreignId('user_id')->constrained();$t->unsignedInteger('views')->default(0);$t->string('status')->default('published');$t->timestamp('published_at')->nullable();$t->timestamps();});
  Schema::create('comments',function(Blueprint $t){$t->id();$t->foreignId('article_id')->constrained()->cascadeOnDelete();$t->string('author_name');$t->text('content');$t->boolean('is_approved')->default(false);$t->timestamps();});
  Schema::create('contacts',function(Blueprint $t){$t->id();$t->string('name');$t->string('email');$t->string('subject');$t->text('message');$t->timestamps();});
 }
 function down(){Schema::dropIfExists('contacts');Schema::dropIfExists('comments');Schema::dropIfExists('articles');Schema::dropIfExists('categories');}
};
