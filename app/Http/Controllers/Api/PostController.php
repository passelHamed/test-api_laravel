<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\post as PostResource;
use App\Models\Post;
use App\Traits\ResponderApi;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PostController extends Controller
{

    use ResponderApi;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->input('limit') <= 50 ? $request->input('limit') : 15;
        $post = PostResource::collection(Post::paginate($limit));
        return $post->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'string|required|max:255',
            'description' => 'string|required',
            'website_id' => 'required|exists:websites,id'
        ]);

        $post = Post::create($data);

        return $this->api_response(201, 'Post Created Successfully!', $post);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = new PostResource(Post::findOrFail($id));
        return $post->response()->setStatusCode(200,'Post Returned Successfully!')->header('Additional Header','True');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = new PostResource(Post::findOrFail($id));
        $post->update($request->all());
        return $post->response()->setStatusCode(200,'Post Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::findOrFail($id)->delete();

        return Response::HTTP_NO_CONTENT;
    }
}
