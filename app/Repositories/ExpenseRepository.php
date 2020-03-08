<?php

namespace App\Repositories;
use App\Expense;

class ExpenseRepository {

    public function get() {

        $result = Expense::with('expenseCategory')->get();

        return $result;

    }

    public function insert($request) {

        $result = Expense::create($request->all());

        return $result;
    }

    public function update($request) {

        $result = Expense::where('id', $request->id)->update($request->except('expense_category'));

        return $result;

    }

    public function delete($request) {

        $result = Expense::where('id', $request->id)->delete();

        return $result;

    }

    public function show($id) {

        $result = Expense::with('expenseCategory')->where('id', $id)->get();

        return $result;
    }
}