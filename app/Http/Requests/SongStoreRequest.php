<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SongStoreRequest extends FormRequest
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
  public function rules(): array
  {
    return [
      'title' => 'required|max:255',
      'author' => 'required|max:255',
      'description' => 'string|nullable',
      'genre_id' => 'required|exists:genres,id',
      'difficulty_level_id' => 'required|exists:difficulty_levels,id',
      'image_file' => 'string|nullable',
      'midi_file' => 'required|string',
      'rating_points' => 'required|numeric'
    ];
  }
}
