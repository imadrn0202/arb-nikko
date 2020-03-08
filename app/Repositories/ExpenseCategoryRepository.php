<?php

namespace App\Repositories;
use App\ExpenseCategory;

class ExpenseCategoryRepository {

    public function get() {

        $result = ExpenseCategory::get();

        return $result;

    }

    public function insert($request) {

        $result = ExpenseCategory::create($request->all());

        return $result;
    }

    public function update($request) {

        $result = ExpenseCategory::where('id', $request->id)->update($request->all());

        return $result;

    }

    public function delete($request) {

        $result = ExpenseCategory::where('id', $request->id)->delete();

        return $result;

    }
}