<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BannerDataTable;
use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     */
    public function index(BannerDataTable $dataTable)
    {
        return $dataTable->render('admin.banner.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'banner_image' => ['required', 'image', 'max:2040'],
            'banner_title' => ['nullable', 'max:255']
        ]);

        $banner = new Banner();

        /** Handle file upload */
        $imagePath = $this->uploadImage($request, 'banner_image', 'uploads');

        $banner->banner_image = $imagePath;
        $banner->banner_title = $request->banner_title;
        $banner->save();

        toastr('Created Successfully', 'success');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banner.edit', compact('banner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'banner_image' => ['nullable', 'image', 'max:2040'],
            'banner_title' => ['required', 'max:255']
        ]);

        $banner = Banner::findOrFail($id);

        /** Handle file upload */
        $imagePath = $this->updateImage($request, 'banner_image', 'uploads', $banner->banner_image);

        $banner->banner_image = empty(!$imagePath) ? $imagePath : $banner->banner_image;
        $banner->banner_title = $request->banner_title;
        $banner->save();

        toastr('Updated Successfully', 'success');
        return redirect()->route('admin.banner.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $banner = Banner::findOrFail($id);
        $this->deleteImage($banner->banner_image);
        $banner->delete();

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
