<?php

namespace App\Http\Controllers;

use App\Repositories\ExpenseRepositoryInterface;
use App\Models\Expenses;
use App\Models\Approvals;
use Illuminate\Http\Request;
use App\Http\Requests\CreateExpensesRequest;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $perPage;
    protected $tables = array('expenses');
    protected Expenses $expenses;
    protected Approvals $approvals;

    public function __construct(

            Expenses $expenses,
            ExpenseRepositoryInterface $expenseRepository,
            Approvals $approvals,
    )
    {
        $this->perPage = 15;
        $this->expense = $expenses;
        $this->expenseRepository = $expenseRepository;
        $this->approvals = $approvals;
    }

    public function index()
    {
        $approverLogin = Auth::id();
        return view('expenses.index',['login'=>$approverLogin]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateExpensesRequest $request)
    {
        // dd($request->all());
        $expense = $this->expenseRepository->createExpense($request->validated());

        if($expense){
            return response()->json([
                'success' => true,
                'message' => 'Expense added successfully',
                'data' => $expense
            ], 201);
        } else {
            return response()->json($expense, 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    /**
         * @OA\Get(
         *     path="/api/expenses",
         *     tags={"Expenses"},
         *     summary="Menampilkan Data",
         *     description="Menampilkan data yang telah dibuat",
         *     @OA\Response(
         *         response=200,
         *         description="Expense data retrieved successfully"
         *     ),
         *     @OA\Response(response=404, description="Expense not found")
         * )
    */
    public function show()
    {
        // $data['main'] = $this->expense->all();
        // foreach ($data['main'] as $key => $value) {
        //     $data['main'][$key]->checkApprovals = $this->approvals->where('expenses_id',$value->id)->get();
        // }
        $approverLogin = Auth::id();
        $data = $this->expenseRepository->loadData();
        return response()->json([
            'data' => $data, 'login' => $approverLogin
        ],201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function edit(Expenses $expenses)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */

    

    public function approve($id, Request $request)
    {
        $execute = $this->expenseRepository->approveExpenses($id, $request->approver);
        if ($execute) {
            return response()->json([
                'success' => true
            ], 201);
        } else {
            return response()->json([
                'success' => false
            ], 500);
        }
        
    }

    public function update(Request $request, Expenses $expenses)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Expenses  $expenses
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expenses $expenses)
    {
        //
    }
}
