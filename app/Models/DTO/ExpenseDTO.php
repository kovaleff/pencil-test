<?php
namespace App\Models\DTO;

use App\Http\Requests\ExpenseRequest;

class ExpenseDTO
{
    public int $summ;
    public string $comment;

    public function fromRequest(ExpenseRequest $request){
        $this->summ = $request->get('sums') ?? 0;
        $this->comment = $request->get('comment') ?? '';
    }
}
