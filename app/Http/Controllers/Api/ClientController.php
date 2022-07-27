<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Http\Resources\ClientResource;
use App\Http\Requests\StoreUpdateClient;
use App\Events\ClientNavigationEvent;
use Carbon\Carbon;
use App\Notifications\notifyClient;

class ClientController extends Controller
{ 
    protected $repository;
    
    public function __construct(Client $model){
        $this->repository = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = $this->repository->get();
        
        return ClientResource::Collection($clients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateClient $request)
    {
        $client = $this->repository->create($request->validated());
        
        $result = new ClientResource($client);

        $client->notify(new notifyClient($client));

        return $result;
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $url
     * @return \Illuminate\Http\Response
     */
    public function show($url)
    {
        $client = $this->repository->where('url', $url)->firstOrFail();

        ClientNavigationEvent::dispatch($client);

        return new ClientResource($client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $url
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateClient $request, $url)
    {
        $client = $this->repository->where('url', $url)->firstOrFail();
        
        $client->update($request->validated());

        return new ClientResource($client);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($url)
    {
        $client = $this->repository->where('url', $url)->firstOrFail();

        $client->delete();

        return response()->json([], 204);
    }
}
