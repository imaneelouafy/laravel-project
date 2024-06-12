<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Block;
use Illuminate\Http\Request;

class BlockController extends Controller
{
    public function index()
    {
        $blocks = Block::withCount('apartments')->get();
        return response()->json($blocks);
    }
    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $block = Block::create(['name' => $request->name]);
        return response()->json($block, 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate(['name' => 'required|string|max:255']);
        $block = Block::findOrFail($id);
        $block->update(['name' => $request->name]);
        return response()->json($block, 200);
    }

    public function destroy($id)
    {
        try {
            $block = Block::findOrFail($id);
            $block->delete();
            return response()->json(null, 204);
        } catch (\Exception $e) {
            // Log the error for debugging
            Log::error('Error deleting block: ' . $e->getMessage());
            // Return an error response
            return response()->json(['error' => 'Error deleting block. Please try again.'], 500);
        }
    }
    public function count()
    {
        $count = Block::count();

        return response()->json(['count' => $count]);
    }
    public function apartments(Block $block)
    {
        return $block->apartments;
    }

}
