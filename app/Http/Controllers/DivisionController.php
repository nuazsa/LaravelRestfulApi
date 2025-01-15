<?php

namespace App\Http\Controllers;

use App\Http\Resources\DivisionResource;
use Illuminate\Http\Request;
use App\Models\Division;
use Illuminate\Http\Exceptions\HttpResponseException;

class DivisionController extends Controller
{
    
    public function index(Request $request): DivisionResource
    {
        $query = Division::query();

        if ($request->has('name') && $request->name) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        $divisions = $query->paginate(2);

        if ($divisions->total() === 0) {
            throw new HttpResponseException(response([
                'status' => 'error',
                'message' => 'Data not found',
            ], 404));
        }

        return new DivisionResource($divisions);
    }
}
