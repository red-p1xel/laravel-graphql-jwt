<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static insert(array $array)
 * @method static findOrFail($id)
 * @method static limit($limit)
 * @property mixed user_id
 */
class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'description', 'data', 'user_id'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
