<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

trait HandlesFileUpload
{
      public function upload(string $property, string $model, string $path)
    {
        // Jika user sudah upload gambar
        if ($this->$property instanceof TemporaryUploadedFile) {
            // Jika model sebelumnya sudah mempunyai gambar
            if ($this->$model->$property) {
                // maka hapus gambar lama mereka
                $this->$model->$property()->delete();
                Storage::delete($this->$model->$property->all());
            }
            // ganti dengan gambar yang baru mereka upload
            $this->$model->$property()->create([
                'url' => $this->$property->store(path: $path)
            ]);
        } else {
            // Jika user tidak memilih gambar, maka gunakan gambar lama mereka
            $this->$property = $this->$model->$property;
        }
    }
}
