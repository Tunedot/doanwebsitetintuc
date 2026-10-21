<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder; use Illuminate\Support\Str; use App\Models\{User,Category,Article,Comment};
class DatabaseSeeder extends Seeder { function run(){
 $a=User::create(['name'=>'Quản trị','email'=>'admin@news.test','password'=>'Admin@123','role'=>'admin']);
 $e=User::create(['name'=>'Biên tập viên','email'=>'editor@news.test','password'=>'Editor@123','role'=>'editor']);
 foreach(['Thời sự','Công nghệ','Thể thao','Giải trí'] as $i=>$n){
  $c=Category::create(['name'=>$n,'slug'=>Str::slug($n),'description'=>"Tin $n"]);
  foreach([1,2] as $k)Article::create(['title'=>"$n: bản tin số $k",'slug'=>Str::slug($n)."-$k",'summary'=>"Tóm tắt bản tin $n số $k.",'content'=>"Nội dung đầy đủ của bản tin $n số $k.\n\nĐây là dữ liệu mẫu.",'category_id'=>$c->id,'user_id'=>$k==1?$a->id:$e->id,'views'=>rand(10,500),'published_at'=>now()->subDays($i+$k)]);
 }
 Comment::create(['article_id'=>1,'author_name'=>'Độc giả','content'=>'Bài viết hay!','is_approved'=>1]);
}}
