<?php

namespace App\Http\Controllers;

use App\Http\Resources\SongResource;
use App\Models\Song;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class SongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        return SongResource::collection(Song::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Song $song
     * @return SongResource
     */
    public function show(int $id)
    {
      return new SongResource(Song::findOrFail($id));
    }

  /**
   * Display the specified resource midi.
   *
   * @param Song $song
   * @return false|string
   */
  public function midi(int $id)
  {
    $song = Song::findOrFail($id);
    $path = public_path('storage/songs-midi/'.$song->midi_file);
    if (file_exists($path)) {
      return file_get_contents($path);
    }
    return public_path('/storage/songs-midi/'.$song->midi_file);
    return response('Cannot load MIDI File', ResponseAlias::HTTP_BAD_REQUEST);
  }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Song $song
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Song $song)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Song $song
     * @return \Illuminate\Http\Response
     */
    public function destroy(Song $song)
    {
        //
    }
}
