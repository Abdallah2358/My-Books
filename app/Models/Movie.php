<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $guarded = [];

    //eager loading 
    protected $with = ['category'];
    //relationship 

    //relation with category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    //relation with user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //filtration 

    public function scopeFilter($query, array $filters)
    {
        //filter based on search
        $query->when(
            $filters['search'] ?? false,
            function ($query, $search) {
                $query-> where(
                    function ($query) use ($search)
                    {
                        $query ->where('name', 'like', "%$search%")
                        ->orWhere('descripto', 'like', "%$search%");
                    }
                );
                   
            }
        );

        // filter based on rating
        $query->when(
            $filters['rating'] ?? false,
            function ($query, $rating) {
                $query-> where(
                    function ($query) use ($rating)
                    {
                        $query ->where('rating', '=', $rating);
                    }
                );
                   
            }
        );

        //filter based on category 
        $query->when(
            $filters['category'] ?? false,
            function ($query, $category) {
                $query
                    ->whereExists(
                        function ($query) use ($category) {
                            $query->from('categories')
                                ->whereColumn ('categories.id',  "movies.category_id")
                                ->where('categories.name', "$category");
                        }
                    );
            }
        );
  
    }
}
