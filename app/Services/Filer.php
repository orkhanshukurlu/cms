<?php

namespace App\Services;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

class Filer
{
    public function upload(string $folder, UploadedFile $file): string|RedirectResponse
    {
        try {
            $this->makeFolder($folder);
            return $this->uploadFile($folder, $file);
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return back()->withError(__('messages.error.photo'));
        }
    }

    public function multiUpload(string $folder, array $files): array|RedirectResponse
    {
        try {
            $result = [];

            foreach ($files as $file) {
                $result[] = $this->uploadFile($folder, $file);
            }

            return $result;
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
            return back()->withError(__('messages.error.photos'));
        }
    }

    public function delete(string $folder, string $file): void
    {
        try {
            $this->deleteFile($folder, $file);
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
        }
    }

    public function multiDelete(string $folder, array $files): void
    {
        try {
            foreach ($files as $file) {
                $this->deleteFile($folder, $file);
            }
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
        }
    }

    protected function makeFolder(string $folder): void
    {
        try {
            if (File::missing('uploads')) {
                File::makeDirectory('uploads', 0777);
            }

            if (File::missing("uploads/$folder")) {
                File::makeDirectory("uploads/$folder", 0777);
            }
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
        }
    }

    protected function uploadFile(string $folder, UploadedFile $file): string
    {
        $fileName = uniqid() . '.' . str($file->extension())->lower();
        $file->move("uploads/$folder", $fileName);
        return $fileName;
    }

    protected function deleteFile(string $folder, string $file): void
    {
        try {
            if (File::exists("uploads/$folder/$file")) {
                File::delete("uploads/$folder/$file");
            }
        }

        catch (Exception $e) {
            logger()->channel('dev')->error($e->getMessage());
        }
    }
}
