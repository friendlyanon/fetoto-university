<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Assets\AssetControllerBase;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AssetController extends AssetControllerBase
{
    /**
     * @param int $id
     * @return BinaryFileResponse
     */
    public function image($id)
    {
        return $this->userImage($id, 'image', 'filename');
    }

    /**
     * @param int $id
     * @return BinaryFileResponse
     */
    public function thumbnail($id)
    {
        return $this->userImage($id, 'thumbnail');
    }
}
