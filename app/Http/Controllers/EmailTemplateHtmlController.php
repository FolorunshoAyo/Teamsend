<?php

namespace App\Http\Controllers;

use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmailTemplateHtmlController extends Controller
{
    /**
     * Store the HTML content in a file and store the file path in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $currUser = $request->get('activeUser');

        // Validate the request data
        $request->validate([
            'content' => 'required|string',
            'template_id' => 'required|string',
        ]);

        $template = Template::find($request->template_id);

        // Get the HTML content from the request
        $htmlContent = $request->content;

        // Define the subfolder name
        $subfolder = 'html-contents';

        // Generate a unique name for the file
        $filename = time() . '.html';

        // Store the HTML content in the storage/app/public/html-contents directory
        Storage::put("public/{$subfolder}/{$filename}", $htmlContent);

        // Get the file path
        $filePath = Storage::url("{$subfolder}/{$filename}");

        // Store the file path in the database
        $template->template_html = $htmlContent;
        $template->template_file_destination = $filePath;
        $template->save();

        // Return a response
        return response()->json(
            [
                'success' => 'Template saved successfully.', 
                // 'file_path' => $filePath
            ]
        );
    }
}
