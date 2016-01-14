<?php
namespace Sasedev\Doctrine\PostgresqlBundle\DBAL;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 *
 */
class IntegerArrayType extends AbstractArrayType
{
    const INTEGERARRAY = 'integer[]';

    protected $name = self::INTEGERARRAY;

    protected $innerTypeName = 'integer';
}
