<?php

namespace app\core\form;

use app\core\Model;

class Field
{
    public Model $model;
    public string $attribute;
    public  function __construct(Model $model, string $attribute)
    {
        $this->model = $model;
        $this->attribute = $attribute;
    }
    public function __toString()
    {
        return sprintf(
            ' 
        <div class="form-group">
            <label for="subjectTitle" class="form-label">%s</label>
            <input type="text" name="%s" value="%s" class="form-control%s">
        </div>
            ',
            $this->attribute,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
        );
    }
}
