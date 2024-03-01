<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory;

    protected $table = 'todos';

    public const ID = "id";
    public const TITLE = "title";
    public const CONTENT = "content";
    public const USER_ID = "user_id";
    public const STATUS = "status";
    public const CREATED_AT = "created_at";
    public const UPDATED_AT = "updated_at";

    protected $fillable = [
        self::TITLE,
        self::CONTENT,
        self::USER_ID,
        self::STATUS
    ];
    protected $dates = [self::CREATED_AT, self::UPDATED_AT];
}
