<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use App\Models\Images;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function index()
    {
        return view('admins.UImage');
    }

    public function imageUpload(Request $request)
    {
        // $collection = collect($request);
        // return $collection->count();
        $Images = new Images;
        $request->validate([
            'image.*' => 'required|image|mimes:jpeg,jpg,png,gif,svg|max:5120',
        ]);
        $i = 1;
        foreach ($request->image as $value) {

            $imageName = time() . '_' . $value->getClientOriginalName();
            $Images->name = $imageName;
            $Images->product_id = $i++;
            $value->move(public_path('images'), $imageName);
            $Images->save();
            // Images::create($request->all());
            $imageNams[] = $imageName;
        }

        return redirect()->back()->withSuccess('You have successfully upload image.')->with('image', $imageNams);
    }
}
