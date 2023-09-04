<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClaimStoreRequest;
use App\Http\Requests\ClaimUpdateRequest;
use App\Http\Resources\ClaimResource;
use App\Models\Claim;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class ClaimController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $appends = $request->get('with', []);

        $claims = Claim::with($appends)
            ->filter($request->get('filters', []))
            ->sort($request->get('sort', 'id-desc'))
            ->paginate($request->get('per_page', $this->per_page));

        return ClaimResource::collection($claims, $appends);
    }

    public function list(Request $request): AnonymousResourceCollection
    {
        $appends = $request->get('appends', []);

        /** @var User $user */
        $user = Auth::user()
            ->load(Arr::collapse([['claims'], $appends]));

        return ClaimResource::collection($user->claims);
    }

    public function show(Request $request, Claim $claim): ClaimResource
    {
        $appends = $request->get('with', []);

        return ClaimResource::make($claim)
            ->addAppends($appends);
    }

    public function store(ClaimStoreRequest $request): ClaimResource
    {
        $data = $request->validated();
        $claim = Claim::query()
            ->create($data);

        return ClaimResource::make($claim);
    }

    public function update(ClaimUpdateRequest $request, Claim $claim): ClaimResource
    {
        $data = $request->validated();
        $claim->update($data);

        return ClaimResource::make($claim);
    }

    public function destroy(Claim $claim): Response
    {
        $claim->delete();

        return response()
            ->noContent();
    }
}
