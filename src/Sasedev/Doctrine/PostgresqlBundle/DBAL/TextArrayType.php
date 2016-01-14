<?php
namespace Sasedev\Doctrine\PostgresqlBundle\DBAL;

/**
 *
 * @author sasedev <sasedev.bifidis@gmail.com>
 *
 */
class TextArrayType extends AbstractArrayType
{
    const TEXTARRAY = 'text[]';

    protected $name = self::TEXTARRAY;

    protected $innerTypeName = 'text';
}
