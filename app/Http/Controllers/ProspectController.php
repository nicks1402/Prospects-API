<?php

namespace App\Http\Controllers;

use App\Models\Prospect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProspectController extends Controller
{
    /**
     * Create a new prospect.
     */
    public function create(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'phone' => 'required|string|unique:prospects|regex:/^\+?[0-9]{10,15}$/',
            'email' => 'required|email|unique:prospects',
            'lead_source' => 'nullable|string|max:255',
            'lead_stage' => 'nullable|string|max:255',
            'assigned_agent' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'property_type' => 'nullable|string|max:255',
            'min_budget' => 'nullable|numeric|min:0',
            'max_budget' => 'nullable|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'n_bed' => 'nullable|integer|min:0',
            'n_bath' => 'nullable|integer|min:0',
            'property_use' => 'nullable|string|max:255',
            'last_contact' => 'nullable|date',
            'next_follow' => 'nullable|date',
            'shortlisted_properties' => 'nullable|array',
            'pre_approved' => 'nullable|boolean',
            'preferred_move_in_date' => 'nullable|date',
        ]);

        // Handle the shortlisted_properties (ensure it's an array or empty if null)
        if ($validated['shortlisted_properties'] === null) {
            $validated['shortlisted_properties'] = [];
        }

        // Create the new prospect
        $prospect = Prospect::create($validated);

        // Return a success response
        return response()->json([
            'message' => 'Prospect created successfully.',
            'data' => $prospect
        ], 201);
    }

    /**
     * List all prospects.
     */
    public function index(Request $request)
    {
        // Optional pagination, using offset and limit
        $offset = $request->query('offset', 0);
        $limit = $request->query('limit', 10);

        // Get the prospects with pagination
        $prospects = Prospect::offset($offset)
                             ->limit($limit)
                             ->get();

        // Return success message with data
        return response()->json([
            'message' => 'Prospects retrieved successfully.',
            'data' => $prospects
        ]);
    }

    /**
     * Fetch a prospect by ID.
     */
    public function show($id)
    {
        // Find the prospect by ID
        $prospect = Prospect::find($id);

        if (!$prospect) {
            // Return error message if not found
            return response()->json([
                'message' => 'Prospect not found.'
            ], 404);
        }

        // Return success message with data
        return response()->json([
            'message' => 'Prospect retrieved successfully.',
            'data' => $prospect
        ]);
    }

    /**
     * Update a prospect by ID.
     */
    public function update(Request $request, $id)
    {
        // Find the prospect by ID
        $prospect = Prospect::find($id);

        if (!$prospect) {
            // Return error message if not found
            return response()->json([
                'message' => 'Prospect not found.'
            ], 404);
        }

        // Validate the incoming data
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'phone' => 'required|string|unique:prospects,phone,' . $id . '|regex:/^\+?[0-9]{10,15}$/',
            'email' => 'required|email|unique:prospects,email,' . $id,
            'lead_source' => 'nullable|string|max:255',
            'lead_stage' => 'nullable|string|max:255',
            'assigned_agent' => 'nullable|string|max:255',
            'status' => 'nullable|string|max:255',
            'property_type' => 'nullable|string|max:255',
            'min_budget' => 'nullable|numeric|min:0',
            'max_budget' => 'nullable|numeric|min:0',
            'location' => 'nullable|string|max:255',
            'n_bed' => 'nullable|integer|min:0',
            'n_bath' => 'nullable|integer|min:0',
            'property_use' => 'nullable|string|max:255',
            'last_contact' => 'nullable|date',
            'next_follow' => 'nullable|date',
            'shortlisted_properties' => 'nullable|array',
            'pre_approved' => 'nullable|boolean',
            'preferred_move_in_date' => 'nullable|date',
        ]);

        // Handle the shortlisted_properties (ensure it's an array or empty if null)
        if ($validated['shortlisted_properties'] === null) {
            $validated['shortlisted_properties'] = [];
        }

        // Update the prospect with validated data
        $prospect->update($validated);

        // Return success message with updated data
        return response()->json([
            'message' => 'Prospect updated successfully.',
            'data' => $prospect
        ]);
    }

    /**
     * Delete a prospect by ID.
     */
    public function destroy($id)
    {
        // Find the prospect by ID
        $prospect = Prospect::find($id);

        if (!$prospect) {
            // Return error message if not found
            return response()->json([
                'message' => 'Prospect not found.'
            ], 404);
        }

        // Delete the prospect
        $prospect->delete();

        // Return success message
        return response()->json([
            'message' => 'Prospect deleted successfully.'
        ]);
    }
}
