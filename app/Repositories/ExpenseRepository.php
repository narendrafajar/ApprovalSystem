<?php

namespace App\Repositories;

use App\Models\Expenses;
use App\Models\Approvals;
use App\Models\ApprovalStages;
use Illuminate\Support\Facades\Auth;
use DB;
// use App\Repositories\ExpenseRepositoryInterface;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class ExpenseRepository implements ExpenseRepositoryInterface
{
    protected $expense;

    public function __construct(Expenses $expense, Approvals $approvals, ApprovalStages $approvalStage)
    {
        $this->expense = $expense;
        $this->approvals = $approvals;
        $this->approvalStage = $approvalStage;
    }

    public function update($id, array $data)
    {
        $updateExpense = $this->expense->findOrFail($id);
        return $updateExpense->update($data);
    }

    public function getById($id)
    {
        return $this->expense->findOrFail($id);
    }

    public function createExpense(array $data)
    {
        // dd($data);
        return $this->expense->create($data);
    }

    public function approveExpenses($expenseId, $approverId)
    {
        $expense = $this->expense->findOrFail($expenseId);
        // $stage = $this->approvalStage->latest()->first();

        // // dd($stage);
        // if ($stage->approver_id != $approverId) {
        //     throw new \Exception('Approver tidak berhak menyetujui saat ini.');
        // }

        $createStage = $this->approvalStage->create([
            'approver_id' => $approverId
        ]);

        $expense->approvals()->create([
            'approver_id' => $approverId,
            'status_id' => 1,
            'expenses_id' => $expenseId
        ]);

        if ($expense->approvals()->count() >= 3) {
            $expense->update(['status_id' => 2]);
        }

        return $expense;

        // dd($stage);
    }

    public function loadData()
    {
        $data['main'] = $this->expense->all();
        foreach ($data['main'] as $key => $value) {
            $checkApprovals = $this->approvals->where('expenses_id',$value->id)->get();
            
            $countApprovalsStatus1 = $checkApprovals->where('status_id',1)->count();
            $countApprovalsStatus2 = $checkApprovals->where('status_id',1)->count();

            $countApproveId1 = $checkApprovals->where('approver_id',1)->count();
            $countApproveId2 = $checkApprovals->where('approver_id',2)->count();
            $countApproveId3 = $checkApprovals->where('approver_id',3)->count();

            $data['main'][$key]->checkApprovals = $checkApprovals;
            $data['main'][$key]->status1 = $countApprovalsStatus1;
            $data['main'][$key]->status2 = $countApprovalsStatus2;

            $data['main'][$key]->approve1 = $countApproveId1;
            $data['main'][$key]->approve2 = $countApproveId2;
            $data['main'][$key]->approve3 = $countApproveId3;

            $data['main'][$key]->currentStatus = $value->status->name;            
        }

        return $data;
    }
}
