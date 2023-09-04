<?php

namespace App\Models;

use Aw3r1se\LaravelUtilities\Traits\FilterableTrait;
use Aw3r1se\LaravelUtilities\Traits\SortableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @Claim
 * @property int $id
 * @property string $topic
 * @property string $message
 * @property string|null $comment
 * @property int $user_id
 * @property int $status_id
 * @property-read User $user
 * @property-read ClaimStatus $status
 */
class Claim extends Model
{
    use FilterableTrait;
    use SortableTrait;
    use HasFactory;

    protected $fillable = [
        'topic',
        'message',
        'comment',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::saving(function (Claim $claim) {
            if ($claim->status->name == 'received') {
                $claim->comment = null;
            }
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(ClaimStatus::class);
    }
}
