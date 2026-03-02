<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryIndexController extends Controller
{
    /**
     * عرض قائمة الصور/المعارض الأخيرة أو العشوائية (عامة)
     */
    public function __invoke(Request $request)
    {
        $query = Gallery::query()
            ->with(['event' => fn($q) => $q->select('id', 'title'), 'user' => fn($q) => $q->select('id', 'name')])
            ->latest();

        if ($request->filled('event_id')) {
            $query->where('event_id', $request->event_id);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('description', 'like', "%{$search}%");
        }

        $galleries = $query->paginate(20);

        return response()->json([
            'data'         => $galleries->items(),
            'current_page' => $galleries->currentPage(),
            'last_page'    => $galleries->lastPage(),
            'total'        => $galleries->total(),
        ]);
    }
}
