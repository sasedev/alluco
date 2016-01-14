<?php
namespace Sasedev\Doctrine\PostgresqlBundle\DBAL;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 *
 */
class BigFloatArrayType extends AbstractArrayType
{

    const BIGFLOATARRAY = 'bigfloat[]';

    protected $name = self::BIGFLOATARRAY;

    protected $innerTypeName = 'float8';
}
