<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\subscribe as SubscribeResource;
use App\Models\Subscribe;
use App\Traits\ResponderApi;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;

class SubscribeController extends Controller
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
        $subscribe = SubscribeResource::collection(Subscribe::paginate($limit));
        return $subscribe->response()->setStatusCode(200);
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
            'email' => ['required', 'email', 'max:255', Rule::unique('subscribers', 'email')->where('website_id', $request->input('website_id'))],
            'website_id' => 'required|exists:websites,id'
        ]);

        $subscribers = Subscribe::create($data);

        return $this->api_response(201, 'Successfully Subscribed To Website.', $subscribers);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $subscribe = new SubscribeResource(Subscribe::findOrFail($id));
        return $subscribe->response()->setStatusCode(200,'User Returned Successfully')->header('Additional Header','True');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Subscribe::findOrFail($id)->delete();

        return Response::HTTP_NO_CONTENT;
    }
}
