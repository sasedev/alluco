<?php

namespace Sasedev\Doctrine\PostgresqlBundle;

use Doctrine\DBAL\Types\Type;
use Sasedev\Doctrine\PostgresqlBundle\DBAL\BigFloatArrayType;
use Sasedev\Doctrine\PostgresqlBundle\DBAL\BigFloatType;
use Sasedev\Doctrine\PostgresqlBundle\DBAL\BigIntArrayType;
use Sasedev\Doctrine\PostgresqlBundle\DBAL\BooleanArrayType;
use Sasedev\Doctrine\PostgresqlBundle\DBAL\BoxType;
use Sasedev\Doctrine\PostgresqlBundle\DBAL\DateIntervalType;
use Sasedev\Doctrine\PostgresqlBundle\DBAL\FloatArrayType;
use Sasedev\Doctrine\PostgresqlBundle\DBAL\HstoreArrayType;
use Sasedev\Doctrine\PostgresqlBundle\DBAL\HstoreType;
use Sasedev\Doctrine\PostgresqlBundle\DBAL\IntegerArrayType;
use Sasedev\Doctrine\PostgresqlBundle\DBAL\SmallIntArrayType;
use Sasedev\Doctrine\PostgresqlBundle\DBAL\TextArrayType;
use Sasedev\Doctrine\PostgresqlBundle\DBAL\TimeTzType;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class SasedevDoctrinePostgresqlBundle extends Bundle
{
    public function __construct()
    {
        Type::addType(BigFloatType::BIGFLOAT, 'Sasedev\Doctrine\PostgresqlBundle\DBAL\BigFloatType');
        Type::addType(BigFloatArrayType::BIGFLOATARRAY, 'Sasedev\Doctrine\PostgresqlBundle\DBAL\BigFloatArrayType');
        Type::addType(BigIntArrayType::BIGINTARRAY, 'Sasedev\Doctrine\PostgresqlBundle\DBAL\BigIntArrayType');
        Type::addType(BooleanArrayType::BOOLEANARRAY, 'Sasedev\Doctrine\PostgresqlBundle\DBAL\BooleanArrayType');
        Type::addType(BoxType::BOX, 'Sasedev\Doctrine\PostgresqlBundle\DBAL\BoxType');
        Type::addType(DateIntervalType::DATEINTERVAL, 'Sasedev\Doctrine\PostgresqlBundle\DBAL\DateIntervalType');
        Type::addType(FloatArrayType::FLOATARRAY, 'Sasedev\Doctrine\PostgresqlBundle\DBAL\FloatArrayType');
        Type::addType(HstoreType::HSTORE, 'Sasedev\Doctrine\PostgresqlBundle\DBAL\HstoreType');
        Type::addType(HstoreArrayType::HSTOREARRAY, 'Sasedev\Doctrine\PostgresqlBundle\DBAL\HstoreArrayType');
        Type::addType(IntegerArrayType::INTEGERARRAY, 'Sasedev\Doctrine\PostgresqlBundle\DBAL\IntegerArrayType');
        Type::addType(SmallIntArrayType::SMALLINTARRAY, 'Sasedev\Doctrine\PostgresqlBundle\DBAL\SmallIntArrayType');
        Type::addType(TextArrayType::TEXTARRAY, 'Sasedev\Doctrine\PostgresqlBundle\DBAL\TextArrayType');
        Type::addType(TimeTzType::TIME_TZ, 'Sasedev\Doctrine\PostgresqlBundle\DBAL\TimeTzType');
    }
}
