<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use Illuminate\Http\Request;
use App\Http\Resources\Lesson as ResourcesLesson;

class LessonController extends Controller
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
        $lessons = ResourcesLesson::collection(Lesson::paginate($limit));
        return $lessons->response()->setStatusCode(200 , "Lessons Returned succefully");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $lesson = new ResourcesLesson(Lesson::create($request->all()));
        return $lesson->response()->setStatusCode(200,"Lesson Created succefully");
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $lesson = new ResourcesLesson(Lesson::findOrFail($id));
        return $lesson->response()->setStatusCode(200,"Lessons Created succefully");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,$id)
    {
        $idLesson =  Lesson::findOrFail($id);
        $this->authorize('update' ,  $idLesson);
        $lesson =  new ResourcesLesson(Lesson::findOrFail($id));
        $lesson->update($request->all());
        return $lesson->response()->setStatusCode(200,"Lessons Updated succefully");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $idLesson =  Lesson::findOrFail($id);
        $this->authorize('delete' ,  $idLesson);
        $lesson = Lesson::findOrFail($id);
        $lesson->delete();
        return 204;
    }
}
