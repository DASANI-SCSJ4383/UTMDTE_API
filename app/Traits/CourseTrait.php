<?php

namespace App\Traits;

use App\Models\Course;

trait CourseTrait
{
    public function getCourse($id)
    {
        $course = Course::find($id);
        $course->ischecked = $course->ischecked == '1' ? true : false;

        return $course;
    }
}
