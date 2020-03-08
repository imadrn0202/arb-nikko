<?php

namespace App\Http\Controllers;

use App\Repositories\ExpenseRepository;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    private $expenseRepository;

    public function __construct(ExpenseRepository $expenseRepository)
    {
        $this->expenseRepository = $expenseRepository;
    }

    public function get() {
        
        return response()->json($this->expenseRepository->get());
    
    }

    public function insert(Request $request) {

        return response()->json($this->expenseRepository->insert($request));
    }
    
    public function update(Request $request) {

        return response()->json($this->expenseRepository->update($request));

    }

    public function show($id) {
        
        return response()->json($this->expenseRepository->show($id));
    
    }

    public function delete(Request $request) {

        return response()->json($this->expenseRepository->delete($request));

    }
}
