<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectsReports extends Model
{
    use HasFactory;
    protected $fillable = ['projects_id', 'title', 'description'];
}
