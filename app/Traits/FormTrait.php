<?php

namespace App\Traits;

use App\Models\Form;

trait FormTrait
{
    public function getForm($id)
    {
        return Form::find($id);
    }
}
