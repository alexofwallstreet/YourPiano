<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SongUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'max:255',
            'author' => 'max:255',
            'description' => 'nullable',
            'genre_id' => 'exists:genres,id',
            'difficulty_level_id' => 'exists:difficulty_levels,id',
            'image_file' => 'image|max:2000',
            'midi_file' => 'mimes:mid',
            'rating_points' => 'numeric'
        ];
    }
}
