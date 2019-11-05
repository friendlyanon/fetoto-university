<?php

namespace App\Http\Requests;

use App\Enums\TierAttributeKey;
use App\User;
use Auth;
use Illuminate\Foundation\Http\FormRequest;

class ImageUploadRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // Auth is checked in the controller via auth middleware
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        /** @var User $user */
        $user = Auth::user();
        $tierAttributes = $user->tier->attributes;
        $allowedMaxSize = $tierAttributes[TierAttributeKey::MAX_SIZE];

        return [
            'name' => 'required|string|max:255',
            'longitude' => 'required_with:latitude|string',
            'latitude' => 'required_with:longitude|string',
            'image' => "required|image|max:$allowedMaxSize",
        ];
    }
}
