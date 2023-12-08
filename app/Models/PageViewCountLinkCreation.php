<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageViewCountLinkCreation extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $table = "page_view_count_link_creations";
    protected $primaryKey = "tracking_no";
}
