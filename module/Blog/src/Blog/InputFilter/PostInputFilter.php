<?php
namespace Blog\InputFilter;

use Zend\InputFilter\InputFilter;

class PostInputFilter extends InputFilter
{
    public function init()
    {
        $this->add([
            'name' => 'header',
            'required' => true,
            'filters' => [
                [
                    'name' => 'StringTrim',
                ],
            ],
        ]);

        $this->add([
            'name' => 'body',
            'required' => true,
            'filters' => [
                [
                    'name' => 'StringTrim',
                ],
            ],
        ]);
    }
}
