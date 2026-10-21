<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Comment extends Model { protected $guarded=[]; function article(){return $this->belongsTo(Article::class);} }
