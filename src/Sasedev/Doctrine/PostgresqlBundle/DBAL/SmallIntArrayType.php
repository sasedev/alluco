<?php
namespace Sasedev\Doctrine\PostgresqlBundle\DBAL;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 *
 */
class SmallIntArrayType extends AbstractArrayType
{
    const SMALLINTARRAY = 'smallint[]';

    protected $name = self::SMALLINTARRAY;

    protected $innerTypeName = 'smallint';
}
