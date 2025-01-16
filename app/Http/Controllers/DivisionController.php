<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomHttpResponseException;
use App\Http\Resources\DivisionResource;
use Illuminate\Http\Request;
use App\Models\Division;

class DivisionController extends Controller
{
    
    public function get(Request $request): DivisionResource
    {
        $query = Division::query();

        if ($request->has('name') && $request->name) {
            $query->where('name', 'LIKE', '%' . $request->name . '%');
        }

        $divisions = $query->paginate(2);

        if ($divisions->total() === 0) {
            throw new CustomHttpResponseException('Data not found', 404);
        }

        return new DivisionResource($divisions);
    }
}
