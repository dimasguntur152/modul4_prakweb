<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Http\Requests\StoreMediaRequest;
use App\Http\Requests\UpdateMediaRequest;
use App\Http\Resources\MediaResource;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $query = Media::query();

        if ($request->has('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $media = $query->with('users')->get();

        // Menggunakan Resource untuk format konsisten
        return MediaResource::collection($media)->additional([
            'message' => 'Daftar semua media'
        ]);
    }

    public function store(StoreMediaRequest $request)
    {
        $media = Media::create($request->validated());

        return (new MediaResource($media))->additional([
            'message' => 'Media berhasil ditambahkan'
        ])->response()->setStatusCode(201);
    }

    public function show(string $id)
    {
        $media = Media::with('users')->find($id);

        if (!$media) {
            return response()->json(['message' => 'Media tidak ditemukan'], 404);
        }

        return (new MediaResource($media))->additional([
            'message' => 'Detail media'
        ]);
    }

    public function update(UpdateMediaRequest $request, string $id)
    {
        $media = Media::find($id);

        if (!$media) {
            return response()->json(['message' => 'Media tidak ditemukan'], 404);
        }

        $media->update($request->validated());

        return (new MediaResource($media))->additional([
            'message' => 'Media berhasil diupdate'
        ]);
    }

    public function destroy(string $id)
    {
        $media = Media::find($id);

        if (!$media) {
            return response()->json(['message' => 'Media tidak ditemukan'], 404);
        }

        $media->delete();

        return response()->json(['message' => 'Media berhasil dihapus'], 200);
    }

    public function addToCollection(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $media = Media::find($id);

        if (!$media) {
            return response()->json(['message' => 'Media tidak ditemukan'], 404);
        }

        if ($media->users()->where('user_id', $request->user_id)->exists()) {
            return response()->json(['message' => 'Media sudah ada di koleksi user ini'], 400);
        }

        $media->users()->attach($request->user_id);

        return response()->json(['message' => 'Media berhasil ditambahkan ke koleksi'], 200);
    }

    public function removeFromCollection(Request $request, string $id)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $media = Media::find($id);

        if (!$media) {
            return response()->json(['message' => 'Media tidak ditemukan'], 404);
        }

        $media->users()->detach($request->user_id);

        return response()->json(['message' => 'Media berhasil dihapus dari koleksi user'], 200);
    }
}
