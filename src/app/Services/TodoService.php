<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Builder;
use App\Models\Todo;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

/**
 * Class TodoRepository
 *
 * @package App\Repositories
 */
class TodoService
{
    /**
     * Get the query builder instance for Todos.
     *
     * @return \Illuminate\Database\Eloquent\Builder The query builder instance.
     */
    private function query(): Builder
    {
        return Todo::query();
    }

    /**
     * Get a Todo by its ID.
     *
     * @param int $id The ID of the Todo.
     * @return \App\Models\Todo The Todo model instance.
     * @throws \Exception If the Todo is not found.
     */
    public function getById(int $id): Model
    {
        $currentUser = Auth::user();
        $todo = $this->query()
            ->where(Todo::USER_ID, $currentUser->id)
            ->where(Todo::ID, $id)
            ->first();
        if (!isset($todo)) {
            throw new Exception("todo not found", 404);
        }
        return $todo;
    }

    /**
     * Get all Todos for the current user.
     *
     * @return \Illuminate\Database\Eloquent\Collection The collection of Todo models.
     * @throws \Exception If no Todos are found for the current user.
     */
    public function getAll(): Collection
    {
        $currentUser = Auth::user();
        $todo = $this->query()->where(Todo::USER_ID, $currentUser->id)->get();
        if (!isset($todo)) {
            throw new Exception("todo not found", 404);
        }
        return $todo;
    }

    /**
     * Delete a Todo by its ID.
     *
     * @param int $id The ID of the Todo to delete.
     * @return \App\Models\Todo The Todo model instance that was deleted.
     * @throws \Exception If the Todo is not found.
     */
    public function delete(int $id): Model
    {
        $currentUser = Auth::user();
        $todo = $this->query()
            ->where(Todo::USER_ID, $currentUser->id)
            ->where(Todo::ID, $id)
            ->first();
        if (!isset($todo)) {
            throw new Exception("todo not found", 404);
        }
        $todo->delete();
        return $todo;
    }

    /**
     * Create a new Todo with the given data.
     *
     * @param array $data The data to create the Todo with.
     * @return \App\Models\Todo The newly created Todo model instance.
     */
    public function create(array $data): Model
    {
        return $this->query()->create($data);
    }

    /**
     * Update a Todo by its ID with the given data.
     *
     * @param int $id The ID of the Todo to update.
     * @param array $data The data to update the Todo with.
     * @return \App\Models\Todo The updated Todo model instance.
     * @throws \Exception If the Todo is not found.
     */
    public function update(int $id, array $data): Model
    {
        $currentUser = Auth::user();
        $todo = $this->query()
            ->where(Todo::USER_ID, $currentUser->id)
            ->where(Todo::ID, $id)
            ->first();
        if (!isset($todo)) {
            throw new Exception("todo not found", 404);
        }
        $todo->update($data);
        return $todo;
    }
}
