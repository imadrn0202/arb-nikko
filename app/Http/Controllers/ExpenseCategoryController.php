<?php

namespace App\Http\Controllers;

use App\Repositories\ExpenseCategoryRepository;
use Illuminate\Http\Request;

class ExpenseCategoryController extends Controller
{
    private $expenseCategoryRepository;

    public function __construct(ExpenseCategoryRepository $expenseCategoryRepository)
    {
        $this->expenseCategoryRepository = $expenseCategoryRepository;
    }

    public function get() {
        
        return response()->json($this->expenseCategoryRepository->get());
    
    }

    public function insert(Request $request) {

        return response()->json($this->expenseCategoryRepository->insert($request));
    }
    
    public function update(Request $request) {

        return response()->json($this->expenseCategoryRepository->update($request));

    }

    public function delete(Request $request) {

        return response()->json($this->expenseCategoryRepository->delete($request));

    }
}
