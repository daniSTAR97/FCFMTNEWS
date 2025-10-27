<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'content',
        'category_id',
        'user_id',
    ];

    // Relationship: an announcement belongs to one category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relationship: an announcement is posted by one user (admin)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
