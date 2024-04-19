<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
    ];

    public function photo(): HasOne
    {
        return $this->HasOne(Photo::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function catagories(): BelongsToMany
    {
        return $this->belongsToMany(Catagory::class, 'product_catagory');
    }

    public function loan(): HasOne
    {
        return $this->HasOne(Loan::class);
    }
}
