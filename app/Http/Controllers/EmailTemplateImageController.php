<?php

namespace App\Http\Controllers;

use App\Models\Organisation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;

class EmailTemplateImageController extends Controller
{
    /**
     * Handle the image upload.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function upload(Request $request)
    {
        $organisation = $request->get('organisation');
        $currUser = $request->get('activeUser');

        // Validate the request data
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Max 2MB
        ]);

        // Get the uploaded image file
        $image = $request->file('file');

        $organisation = Organisation::whereHas('userOrganisations', function ($query) use ($currUser) {
            $query->where('user_id', $currUser->id);
        })->first(); 

        $reformatted_org_name = strtolower(join("-", explode(" ", $organisation->name)));

        // Define the custom folder name
        $folder = $reformatted_org_name;

        // Generate a unique name for the image
        $imageName = time().'.'.$image->getClientOriginalExtension();

        // Store the image in the storage/app/public/custom-folder directory
        $path = $image->storeAs("public/{$folder}", $imageName);

        // Get the URL of the stored image
        $url = Storage::url($path);

        // Return a response with the image path
        return response()->json(['url' => $url]);
    }
}
