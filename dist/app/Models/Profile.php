<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Profile
 * @package App\Models
 *
 * @property string $filename
 * @property string $filepath
 *
 */
class Profile extends Model
{
    use HasFactory, Uuids;

    protected $fillable = [
        'fileName', 'filePath'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
