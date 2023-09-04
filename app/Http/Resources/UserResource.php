<?php

namespace App\Http\Resources;

use App\Models\User;
use Aw3r1se\LaravelUtilities\Resources\RestApiResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin User
 */
class UserResource extends RestApiResource
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
            'name' => $this->name,
            'email' => $this->email,
        ];
    }

    public function appendRoles(array $result): array
    {
        $result['roles'] = RoleResource::collection($this->roles);

        return $result;
    }

    public function appendFull(array $result): array
    {
        return $this->appendTimestamps($result);
    }
}
