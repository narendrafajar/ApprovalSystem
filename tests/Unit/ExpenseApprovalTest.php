<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Expenses;
use App\Models\ApprovalStages;
use App\Models\User;
use DB;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExpenseApprovalTest extends TestCase
{
    use RefreshDatabase;

    public function test_expense_approval()
    {
        // Seed status data
        $statuses = [
            ['id' => 1, 'name' => 'menunggu persetujuan', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'disetujui', 'created_at' => now(), 'updated_at' => now()],
        ];
        DB::table('statuses')->insert($statuses);

        // Create approvers: Ana, Ani, Ina
        $approvers = User::factory()->createMany([
            ['code' => 'APP20241100001', 'name' => 'Ana', 'email' => 'ana@app.serv', 'role' => 'Approver', 'password' => bcrypt('approver1')],
            ['code' => 'APP20241100002', 'name' => 'Ani', 'email' => 'ani@app.serv', 'role' => 'Approver', 'password' => bcrypt('approver2')],
            ['code' => 'APP20241100003', 'name' => 'Ina', 'email' => 'ina@app.serv', 'role' => 'Approver', 'password' => bcrypt('approver3')],
        ]);

        // Create approval stages for each approver
        foreach ($approvers as $index => $approver) {
            ApprovalStages::factory()->create([
                'approver_id' => $approver->id
            ]);
        }

        // Create 4 expenses
        $expenses = Expenses::factory()->count(4)->create(['status_id' => 1]); // Default to 'menunggu persetujuan'

        // Approval Scenarios
        // 1. Approve all approvers for the first expense
        foreach ($approvers as $approver) {
            $this->actingAs($approver)->patchJson(route('expenses.approve', ['id' => $expenses[0]->id]), [
                'approver' => $approver->id
            ]);
        }
        $this->assertEquals(2, Expenses::find($expenses[0]->id)->status_id); // Check if status is 'disetujui'

        // 2. Approve two approvers for the second expense
        for ($i = 0; $i < 2; $i++) {
            $this->actingAs($approvers[$i])->patchJson(route('expenses.approve', ['id' => $expenses[1]->id]), [
                'approver' => $approvers[$i]->id
            ]);
        }
        $this->assertEquals(1, Expenses::find($expenses[1]->id)->status_id); // Status should still be 'menunggu persetujuan'

        // 3. Approve one approver for the third expense
        $this->actingAs($approvers[0])->patchJson(route('expenses.approve', ['id' => $expenses[2]->id]), [
            'approver' => $approvers[0]->id
        ]);
        $this->assertEquals(1, Expenses::find($expenses[2]->id)->status_id); // Status should still be 'menunggu persetujuan'

        // 4. No approver for the fourth expense
        $this->assertEquals(1, Expenses::find($expenses[3]->id)->status_id); // Status should still be 'menunggu persetujuan'

        // // Assertions for each scenario's response and status
        // foreach ($expenses as $index => $expense) {
        //     $response = $this->getJson(route('expenses.show'));
        //     if ($index == 0) {  
        //         $response->assertJson([
        //             'success' => true
        //         ]);
        //     } else {
        //         $response->assertJson(500); 
        //     }
        // }
    }
}
