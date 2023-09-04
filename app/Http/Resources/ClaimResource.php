<?php

namespace App\Http\Resources;

use App\Models\Claim;
use Aw3r1se\LaravelUtilities\Resources\RestApiResource;

/**
 * @mixin Claim
 */
class ClaimResource extends RestApiResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toDefaultArray(): array
    {
        return [
            'id' => $this->id,
            'topic' => $this->topic,
            'user_id' => $this->user_id,
            'status_id' => $this->status_id,
            'comment' => $this->comment,
        ];
    }

    public function appendUser(array $result): array
    {
        $result['user'] = UserResource::make($this->user);

        return $result;
    }

    public function appendStatus(array $result): array
    {
        $result['status'] = ClaimStausResource::make($this->status);

        return $result;
    }

    public function appendFull(array $result): array
    {
        $result = $this->appendUser($result);
        $result = $this->appendStatus($result);

        return $this->appendTimestamps($result);
    }
}
