<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
  use HasFactory;

  protected $fillable = [
    'status',
    'name',
    'description',
    'author_id',
    'doer_id',
    'marks'
  ];
}
