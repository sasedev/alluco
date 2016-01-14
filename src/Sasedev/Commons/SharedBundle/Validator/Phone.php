<?php

namespace Sasedev\Commons\SharedBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * Phone Constraint
 *
 * @Annotation
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 */
class Phone extends Constraint
{

    public $message = 'the "%string%" has not a valid EPP phone number format (+CCC.NNNNNNNNNNxEEEE)';

    public $format = "/((^\+[0-9]{1,3}\.[0-9]{3,14}(?:x.+)?$)|(^[1-9][0-9]{2,13}$))/";

    /**
     * Get requiredOptions
     *
     * @return multitype:
     */
    public function requiredOptions()
    {

        return array();

    }

    /**
     * Get defaultOption
     *
     * @return string
     */
    public function defaultOption()
    {

        return 'format';

    }

    /**
     * (non-PHPdoc)
     *
     * @see \Symfony\Component\Validator\Constraint::validatedBy()
     *
     * @return string Validator Class
     */
    public function validatedBy()
    {

        return get_class($this) . 'Validator';

    }
}
