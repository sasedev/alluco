<?php
namespace Sasedev\Doctrine\PostgresqlBundle\DBAL;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 *
 */
class FloatArrayType extends AbstractArrayType
{

    const FLOATARRAY = 'float[]';

    protected $name = self::FLOATARRAY;

    protected $innerTypeName = 'float';
}
