<?php
namespace Sasedev\Doctrine\PostgresqlBundle\DBAL;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 *
 */
class HstoreArrayType extends AbstractArrayType
{
    const HSTOREARRAY = 'hstore[]';

    protected $name = self::HSTOREARRAY;

    protected $innerTypeName = 'hstore';
}
