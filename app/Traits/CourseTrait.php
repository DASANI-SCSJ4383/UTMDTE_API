<?php

namespace App\Traits;

use App\Models\Form;
use App\Models\Course;
use App\Traits\FormTrait;

trait CourseTrait
{
    use FormTrait;

    public function checkForm($course)
    {
        if (isset($course->formid)) {
            $form = $this->getForm($course->formid);
            $course->setAttribute('form', $form);

            unset($course->formid);
        }
    }

    public function changeIsChecked($course)
    {
        $course->ischecked = $course->ischecked == '1' ? true : false;
    }

    public function getCourse($id)
    {
        $course = Course::find($id);

        $this->checkForm($course);

        $this->changeIsChecked($course);

        return $course;
    }

    public function getCoursesByLecturer($lecturerID)
    {
        $courses = Course::where('lecturerID', $lecturerID)
            ->get()
            ->each(function ($course) {
                $this->checkForm($course);

                $this->changeIsChecked($course);
            });

        return $courses;
    }

    public function getCoursesByStudent($studentID)
    {
        $courses = Course::where('studentID', $studentID)
            ->get()
            ->each(function ($course) {
                $this->checkForm($course);

                $this->changeIsChecked($course);
            });

        return $courses;
    }
}
