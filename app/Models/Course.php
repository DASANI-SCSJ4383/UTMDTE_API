<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'section',
        'code',
        'title',
        'isChecked',
        'formID',
        'lecturerID',
        'sessionID',
    ];

    public function setForm($formID)
    {
        $this->formID = $formID;
    }
}
