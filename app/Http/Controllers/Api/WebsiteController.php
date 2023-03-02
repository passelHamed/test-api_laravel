<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Website;
use Illuminate\Http\Request;
use App\Traits\ResponderApi;
use App\Http\Resources\website as websiteResource;
use Illuminate\Http\Response;

class WebsiteController extends Controller
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
        $website = WebsiteResource::collection(website::paginate($limit));
        return $website->response()->setStatusCode(200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|string',
            'url'   => 'required|url',
        ]);

        $website = Website::create($validate);

        return $this->api_response(201, 'Website Subscribed To Website.', $website);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\website  $website
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $website = new WebsiteResource(website::findOrFail($id));
        return $website->response()->setStatusCode(200,'Website Returned Successfully')->header('Additional Header','True');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\website  $website
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $website = new WebsiteResource(Website::findOrFail($id));
        $website->update($request->all());
        return $website->response()->setStatusCode(200,'Website Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\website  $website
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Website::findOrFail($id)->delete();

        return Response::HTTP_NO_CONTENT;
    }
}
