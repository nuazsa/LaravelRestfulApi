<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Resources\EmployeeCollection;
use App\Exceptions\CustomHttpResponseException;
use App\Helpers\ResponseHelper;
use App\Http\Requests\EmployeeCreateRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use Illuminate\Support\Facades\Storage;
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
                'division_id' => $request->division_id,
                'position' => $request->position,
            ]);

            return ResponseHelper::success('Data created successfully', null, 201);
        } catch (\Exception $e) {
            throw new CustomHttpResponseException('Failed to create employee: ' . $e->getMessage(), 500);
        }
    }

    public function update(EmployeeUpdateRequest $request, $id): JsonResponse
    {
        $data = $request->validated();
        $employee = Employee::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($employee->image) {
                Storage::disk('public')->delete($employee->image);
            }
        
            $data['image'] = $request->file('image')->store('employees', 'public');
            if ($employee->image !== $data['image']) {
                $employee->image = $data['image'];
            }
        }
        
        $employee->update($data);

        return ResponseHelper::success('Data updated successfully', null, 200);
        
    }

    public function delete($id): JsonResponse
    {
        $employee = Employee::findOrFail($id);

        try {
            if ($employee->image) {
                Storage::disk('public')->delete($employee->image);
            }

            $employee->delete();

            return ResponseHelper::success('Data deleted successfully', null, 200);
        } catch (\Throwable $e) {
            throw new CustomHttpResponseException('Failed to delete employee: ' . $e->getMessage(), 500);
        }
    }
}