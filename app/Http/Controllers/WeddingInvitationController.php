<?php

namespace App\Http\Controllers;

use App\Models\Wedding;
use Illuminate\Http\Request;

class WeddingInvitationController extends Controller
{
    public function show(string $slug)
    {
        $wedding = Wedding::where('slug', $slug)
            ->where('is_active', true)
            ->with(['loveStories', 'giftAccounts', 'wishes'])
            ->firstOrFail();

        return view($wedding->theme_view, compact('wedding'));
    }

    public function storeWish(Request $request, string $slug)
    {
        $wedding = Wedding::where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        $wish = $wedding->wishes()->create($validated);

        // Jika request berasal dari Fetch API / AJAX
        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Ucapan terkirim!',
                'data' => $wish
            ]);
        }

        return back()->with('success', 'Ucapan terkirim!');
    }
}