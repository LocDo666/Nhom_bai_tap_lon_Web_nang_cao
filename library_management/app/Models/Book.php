<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'author',
        'publisher',
        'year',
        'description',
        'cover_image',
        'category',
        'views',
        'downloads',
    ];

    // Quan hệ 1-nhiều: Một sách có thể được mượn nhiều lần
    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }

    // Hàm lọc tìm kiếm và sắp xếp linh hoạt
    public function scopeFilter($query, $filters)
    {
        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('title', 'like', "%{$filters['search']}%")
                  ->orWhere('author', 'like', "%{$filters['search']}%");
            });
        }

        if (!empty($filters['category'])) {
            $query->where('category', $filters['category']);
        }

        if (!empty($filters['year'])) {
            $query->where('year', $filters['year']);
        }

        if (!empty($filters['sort'])) {
            switch ($filters['sort']) {
                case 'views':
                    $query->orderByDesc('views');
                    break;
                case 'downloads':
                    $query->orderByDesc('downloads');
                    break;
                case 'latest':
                    $query->orderByDesc('created_at');
                    break;
            }
        }

        return $query;
    }
}
