<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Resources\EmployeeCollection;
use App\Exceptions\CustomHttpResponseException;
use App\Http\Requests\EmployeeCreateRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Illuminate\Support\Str;

class EmployeeController extends Controller
{
    public function get(Request $request): JsonResponse
    {
        $query = Employee::query()->with('division');

        if ($request->has('name') && $request->name) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        if ($request->has('division_id') && $request->division_id) {
            $query->where('division_id', $request->division_id);
        }

        $employees = $query->paginate(2);

        if ($employees->total() === 0) {
            throw new CustomHttpResponseException('Data not found', 404);
        }

        return response()->json(new EmployeeCollection($employees));
    }

    public function create(EmployeeCreateRequest $request): JsonResponse
    {
        try {
            $imagePath = $request->file('image')->store('employees', 'public');

            Employee::create([
                'id' => Str::uuid(),
                'name' => $request->name,
                'phone' => $request->phone,
                'image' => $imagePath,
                'division_id' => $request->division,
                'position' => $request->position,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data created successfully',
            ], 201);
        } catch (\Exception $e) {
            throw new CustomHttpResponseException('Failed to create employee: ' . $e->getMessage(), 500);
        }
    }
}