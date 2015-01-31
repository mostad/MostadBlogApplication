<?php
namespace Blog\InputFilter;

use Zend\Filter\StringTrim;
use Zend\InputFilter\InputFilter;
use Zend\Validator\StringLength;

class PostInputFilter extends InputFilter
{
    public function init()
    {
        $this->add([
            'name' => 'header',
            'required' => true,
            'filters' => [
                [
                    'name' => StringTrim::class,
                ],
            ],
            'validators' => [
                [
                    'name' => StringLength::class,
                    'options' => [
                        'max' => 128,
                    ],
                ],
            ],
        ]);

        $this->add([
            'name' => 'body',
            'required' => true,
            'filters' => [
                [
                    'name' => StringTrim::class,
                ],
            ],
        ]);
    }
}
