<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lesson;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class RelationshipController extends Controller
{
    public function userLessons($id)
    {
        $lessons = User::findOrFail($id)->lessons;
        $fields = [];
        $filtered = [];
        foreach($lessons as $lesson)
        {
            $fields['Title'] = $lesson->title;
            $fields['Content'] = $lesson->body;
            $filtered[] = $fields;
        }
        return Response::json(['data'=>$filtered]
        ,200) ;

    }
    public function lessonTags($id)
    {
        $tags = Lesson::findOrFail($id)->tags;
        $fields = [];
        $filtered = [];
        foreach($tags as $tag)
        {
            $fields['Tag'] = $tag->name;
            $filtered[] = $fields;
        }
        return Response::json(['data'=>$filtered]
        ,200) ;
    }
    public function tagLessons($id)
    {
        $tag = Tag::findOrFail($id)->lessons;
        $fields = [];
        $filtered = [];
        foreach($tag as $lesson)
        {
            $fields['Title'] = $lesson->title;
            $fields['Content'] = $lesson->body;
            $filtered[] = $fields;
        }
        return Response::json(['data'=>$filtered]
        ,200) ;
    }
}
