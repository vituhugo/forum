<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\UploadedFile;

class File extends Model
{
    protected $fillable = ['file'];

    public static function makeFromUploadFile(UploadedFile $file, $path = 'files', $disk = 'public') {
        $that = new self();
        $that->name = $file->getClientOriginalName();
        $that->mime_type = $file->getMimeType();
        $that->extension = $file->getExtension();
        $that->size = $file->getSize();
        $that->path = $file->store($path, $disk);
        return $that;
    }
}
