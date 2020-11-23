<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;

trait ImageTrait
{
    /**
     * Store image and get file path.
     *
     * @return string
     */
    public function storeImageAndGetPath($directory, $id, $fileName)
    {
        $path_of_directory = 'public/'.$directory.'/'.$id;
        
        // If directory doesn't exists create a new one.
        if (!Storage::exists($path_of_directory)) {
            Storage::makeDirectory($path_of_directory, 0775);
        }

        // Storing new file in to folder.
        $path_of_file = ($fileName) ? $fileName->store($path_of_directory) : '';

        return $path_of_file;
    }

}
