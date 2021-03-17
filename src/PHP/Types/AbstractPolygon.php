<?php

/**
 * Copyright (C) 2015 Derek J. Lambert
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace Bcremer\Spatial\PHP\Types;

/**
 * Abstract Polygon object for POLYGON spatial types
 *
 * @author  Derek J. Lambert <dlambert@dereklambert.com>
 * @license http://dlambert.mit-license.org MIT
 */
abstract class AbstractPolygon extends AbstractGeometry
{
    /**
     * @var array[] $rings
     */
    protected $rings = [];

    /**
     * @param AbstractLineString[]|array[] $rings
     */
    public function __construct(array $rings)
    {
        $this->setRings($rings);
    }

    /**
     * @param AbstractLineString|array[] $ring
     *
     * @return self
     */
    public function addRing($ring): AbstractPolygon
    {
        $this->rings[] = $this->validateRingValue($ring);

        return $this;
    }

    /**
     * @return AbstractLineString[]
     */
    public function getRings(): array
    {
        $rings = [];

        for ($i = 0; $i < count($this->rings); $i++) {
            $rings[] = $this->getRing($i);
        }

        return $rings;
    }

    /**
     * @param int $index
     *
     * @return AbstractLineString
     */
    public function getRing(int $index): AbstractLineString
    {
        if (-1 == $index) {
            $index = count($this->rings) - 1;
        }

        $lineStringClass = $this->getNamespace() . '\LineString';

        return new $lineStringClass($this->rings[$index]);
    }

    /**
     * @param AbstractLineString[] $rings
     *
     * @return self
     */
    public function setRings(array $rings): AbstractPolygon
    {
        $this->rings = $this->validatePolygonValue($rings);

        return $this;
    }

    public function getType(): string
    {
        return self::POLYGON;
    }

    public function toArray(): array
    {
        return $this->rings;
    }
}