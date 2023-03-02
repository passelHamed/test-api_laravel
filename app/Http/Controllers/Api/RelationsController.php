<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Website;
use Illuminate\Support\Facades\Response;
use Illuminate\Http\Request;

class RelationsController extends Controller
{
    public function websitePosts($id)
    {
        $website = Website::findOrFail($id)->posts;
        $fields = array();
        $filtered = array();
        foreach ($website as $post) {
            $fields['Title'] = $post->title;
            $fields['Content'] = $post->description;
            $fields['website_id'] = $post->website_id;
            $filtered[] = $fields;
        }
        return Response::json([
            'data' => $filtered,
        ],200);;
    }
}
