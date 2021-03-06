<?php

namespace Bcremer\Spatial\ORM\Query\AST\Functions\MySql;

use Bcremer\Spatial\ORM\Query\AST\Functions\AbstractSpatialDQLFunction;

/**
 * Description of STContains
 *
 * @author Maximilian
 */
class DistanceFromMultyLine extends AbstractSpatialDQLFunction
{


    protected string $functionName = 'distance_from_multyline';

    protected ?int $minGeomExpr = 2;

    protected ?int $maxGeomExpr = 2;
}
