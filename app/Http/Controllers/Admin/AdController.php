<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ad;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.ads.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.ads.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {

//        return $request;
        $request->validate([
            'media' => 'required',
        ]);
        $uuid = $this->unique_code(5);
        $ad = Ad::create($request->all());
        foreach ($request['media'] as $item) {
            $media = $ad->addMedia($item)
                ->sanitizingFileName(function ($fileName) {
                    return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                })->usingFileName(Carbon::now()->timestamp . '-' . $item->getClientOriginalName())
                ->withCustomProperties(['description' => $request['description']])
                ->toMediaCollection($ad['id'] . '-Ads.' . $uuid);

        }
//        $ad->update([
//            'collection_name' => $ad['id'] . '-Ads.' . $uuid,
//        ]);
        $this->actionSuccess();
        return redirect()->route('ads.index');

    }

    /**
     * Display the specified resource.
     *
     * @param Ad $ad
     * @return Response
     */
    public function show(Ad $ad)
    {
        return view('admin.ads.show', compact('ad'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Ad $ad
     * @return Response
     */
    public function edit(Ad $ad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Ad $ad
     * @return Response
     */
    public function update(Request $request, Ad $ad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Ad $ad
     * @return Response
     * @throws Exception
     */
    public function destroy(Ad $ad)
    {
        $ad->delete();
        $this->actionSuccess();
        return back();
    }
}
