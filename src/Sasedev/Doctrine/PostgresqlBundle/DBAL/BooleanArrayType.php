<?php
namespace Sasedev\Doctrine\PostgresqlBundle\DBAL;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 *
 */
class BooleanArrayType extends AbstractArrayType
{

    const BOOLEANARRAY = 'boolean[]';

    protected $name = self::BOOLEANARRAY;

    protected $innerTypeName = 'boolean';
}
