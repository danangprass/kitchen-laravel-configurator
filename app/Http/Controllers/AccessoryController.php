<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccessoryStoreRequest;
use App\Http\Requests\AccessoryUpdateRequest;
use App\Http\Resources\AccessoryCollection;
use App\Http\Resources\AccessoryResource;
use App\Models\Accessory;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AccessoryController extends Controller
{
    public function index(Request $request): AccessoryCollection
    {
        $accessories = Accessory::all();

        return new AccessoryCollection($accessories);
    }

    public function store(AccessoryStoreRequest $request): AccessoryResource
    {
        $accessory = Accessory::create($request->validated());

        return new AccessoryResource($accessory);
    }

    public function show(Request $request, Accessory $accessory): AccessoryResource
    {
        return new AccessoryResource($accessory);
    }

    public function update(AccessoryUpdateRequest $request, Accessory $accessory): AccessoryResource
    {
        $accessory->update($request->validated());

        return new AccessoryResource($accessory);
    }

    public function destroy(Request $request, Accessory $accessory): Response
    {
        $accessory->delete();

        return response()->noContent();
    }
}
