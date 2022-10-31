<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use function PHPUnit\Framework\assertTrue;

class Artist extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function category()
    {

        return $this->belongsTo(Category::class);

}
}
