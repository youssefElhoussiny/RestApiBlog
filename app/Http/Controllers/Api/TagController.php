<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Resources\Tag as ResourcesTag;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index' , 'show']);
    }
    public function index(Request $request)
    {
        $limit = $request->input('limit') <= 50 ?$request->input('limit'): 15;
        $tags = ResourcesTag::collection(Tag::paginate($limit)) ;
        return $tags->response()->setStatusCode(200,"Tags Returned succefully");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('create' , Tag::class);

        $tag = new ResourcesTag(Tag::create($request->all()));
        return $tag->response()->setStatusCode(200 ,"Tag Created succefully");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tag = new ResourcesTag(Tag::findOrFail($id));
        return $tag->response()->setStatusCode(200, "Tag Returned succefully");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $idTag = Tag::finfOrFail($id);
        $this->authorize('update' , $idTag);

        $tag = new ResourcesTag(Tag::findOrFail($id));
        $tag->update($request->all());
        return $tag->response()->setStatusCode(200, "Tag Updated succefully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $idTag = Tag::finfOrFail($id);
        $this->authorize('delete' , $idTag);
        $tag = Tag::findOrFail($id);
        $tag->delete();
        return 204;
    }
}
