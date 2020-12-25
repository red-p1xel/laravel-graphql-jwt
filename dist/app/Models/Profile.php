<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, mixed $id)
 * @method static findOrFail($id)
 * @property mixed|string filename
 * @property mixed user_id
 * @property mixed filePath
 */
class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'filename', 'filepath'
    ];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
