<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @ClaimStatus
 * @property int $id
 * @property string $name
 * @property-read Collection<Claim> $claims
 */
class ClaimStatus extends Model
{
    protected $fillable = [
        'name',
    ];

    public function claims(): HasMany
    {
        return $this->hasMany(Claim::class);
    }
}
