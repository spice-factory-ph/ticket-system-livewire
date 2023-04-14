<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Ticket extends Model
{
    use HasFactory;

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function priority()
    {
        return $this->belongsTo(Priority::class);
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function reporter()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function scopeAssigned($query)
    {
        $user = Auth::user();

        return $query->where('assigned_to', $user->id);
    }

    public function scopeSearch($query, $request)
    {
        $search = $request['search'] ?? '';
        $assignee = $request['assignee'] ?? '';


        $query->when($search, function ($query) use ($search) {
            $query->where('title', 'like', "%$search%");
        });

        $query->when($assignee, function ($query) use ($assignee) {
            $query->where('assigned_to', $assignee);
        });
    }
}
