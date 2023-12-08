<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageViewCountLog extends Model
{
    use HasFactory;
    protected $table = "page_view_count_logs";
    protected $primaryKey = "id";
}
