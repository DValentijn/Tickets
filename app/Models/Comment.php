<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = ['body', 'ticket_id', 'user_id', 'image_path'];

    /**
     * Get the user that authored the comment.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the ticket associated with the comment.
     */
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    /**
     * Accessor to get the full URL to the attached image.
     *
     * @return string|null
     */
    public function getImageUrlAttribute()
    {
        return $this->image_path ? \Storage::url($this->image_path) : null;
    }
}
