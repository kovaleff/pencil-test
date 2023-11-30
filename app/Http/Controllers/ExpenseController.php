<?php

namespace App\Http\Controllers;

use App\Http\Resources\ExpenseResource;
use App\Models\Expense;
use Illuminate\Http\Response;
use App\Http\Requests\ExpenseRequest;

class ExpenseController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ExpenseResource::collection(Expense::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ExpenseRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseRequest $request)
    {
        $validated = $request->validated();

        $expense = Expense::create(
            $validated
        );
        return (new ExpenseResource($expense))->response()->setStatusCode(Response::HTTP_CREATED);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Expense  $expense
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        return new ExpenseResource(Expense::where('uuid', $uuid)->firstOrFail());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ExpenseRequest  $request
     * @param  string  $uuid
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenseRequest $request, $uuid)
    {
        $expense = Expense::where('uuid', $uuid)->firstOrFail();
        $validated = $request->validated();
        $expense->summ = $validated['summ'];
        $expense->comment = $validated['comment'];
        $expense->save();
        return response()->noContent();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string $uuid
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $expense = Expense::where('uuid', $uuid)->firstOrFail();
        $expense->delete();
        return response()->noContent();
    }
}
