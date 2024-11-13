<?php

namespace App\Repositories;

interface ExpenseRepositoryInterface
{
    public function createExpense(array $data);

    public function update($id, array $data);

    public function getById($id);

    public function approveExpenses($expenseId, $approverId);

    public function loadData();
}