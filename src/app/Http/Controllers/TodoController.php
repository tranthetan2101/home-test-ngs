<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateTodoRequest;
use App\Services\TodoService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    private TodoService $todoService;

    public function __construct(TodoService $todoService)
    {
        $this->todoService = $todoService;
    }

    public function create(CreateTodoRequest $request){
        $data = $request->toArray();
        $data["user_id"] = Auth::id();
        try {
            DB::beginTransaction();
            $this->todoService->create($data);
            DB::commit();
            return view("dashboard");
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function update(CreateTodoRequest $request, int $id){
        $data = $request->toArray();
        try {
            DB::beginTransaction();
            $this->todoService->update($id, $data);
            DB::commit();
            return view("dashboard");
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function list(){
        try {
            $todos = $this->todoService->getAll();
            return view("dashboard", ["todos" => $todos]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function get(int $id){
        try {
            $todo = $this->todoService->getById($id);
            return view("todo.index", ["todo" => $todo]);
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function delete(int $id){
        try {
            DB::beginTransaction();
            $this->todoService->delete($id);
            DB::commit();
            return view("dashboard");
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function redirectCreate(){
        return view("todo.create");
    }
}
