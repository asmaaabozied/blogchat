<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FamilyBlog;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class FamilyBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.familyblog.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.familyblog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'media' => 'required'
        ]);
        $family = FamilyBlog::create([]);
        foreach ($request['media'] as $item) {
            $media = $family->addMedia($item)
                ->sanitizingFileName(function ($fileName) {
                    return strtolower(str_replace(['#', '/', '\\', ' '], '-', $fileName));
                })->usingFileName(Carbon::now()->timestamp . '-' . $item->getClientOriginalName())
                ->toMediaCollection('family');
        }
        $this->actionSuccess();
        return redirect()->route('family.index');
    }

    /**
     * Display the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Media $family
     * @return Response
     * @throws \Exception
     */
    public function destroy(Media  $family)
    {
        $family->delete();
        $this->actionSuccess();
        return back();
    }
}
