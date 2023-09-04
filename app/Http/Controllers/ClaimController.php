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
use Illuminate\Support\Facades\Auth;

class ClaimController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        $claims = Claim::filter($request->get('filters', []))
            ->sort($request->get('sort', 'id-desc'))
            ->paginate($request->get('per_page', $this->per_page));

        return ClaimResource::collection($claims, $request->get('with', []));
    }

    public function list(Request $request): AnonymousResourceCollection
    {
        /** @var User $user */
        $user = Auth::user();

        return ClaimResource::collection($user->claims);
    }

    public function show(Claim $claim): ClaimResource
    {
        return ClaimResource::make($claim);
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
