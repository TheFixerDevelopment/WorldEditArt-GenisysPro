<?php

/*
 *
 * WorldEditArt
 *
 * Copyright (C) 2017 SOFe
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 */

declare(strict_types=1);

namespace LegendsOfMCPE\WorldEditArt\Epsilon\LibgeomAdapter;

use pocketmine\math\Vector3;
use sofe\libgeom\Shape;

class ShapeWrapper implements IShape{
	/** @var Shape */
	private $baseShape;
	/** @var string|void */
	private $shortName;

	/**
	 * ShapeWrapper constructor.
	 *
	 * @param Shape $baseShape
	 *
	 * @internal This class must not be instantiated beyond the scope of this plugin.
	 */
	public function __construct(Shape $baseShape){
		$this->baseShape = $baseShape;
	}

	/**
	 * @return Shape
	 *
	 * @internal This method must not be used beyond the scope of this plugin.
	 */
	public function getBaseShape() : Shape{
		return $this->baseShape;
	}

	public function getShortName() : string{
		return $this->shortName ?? ($this->shortName = (new \ReflectionClass($this->baseShape))->getShortName());
	}

	public function isInside(Vector3 $vector) : bool{
		return $this->baseShape->isInside($vector);
	}

	public function getEstimatedSize() : int{
		return $this->baseShape->getEstimatedSize();
	}

	public function getSolidStream(Vector3 $vector) : \Iterator{
		return $this->baseShape->getSolidStream($vector);
	}

	public function getShallowStream(Vector3 $vector, float $padding, float $margin) : \Iterator{
		return $this->baseShape->getShallowStream($vector, $padding, $margin);
	}

	public function marginalDistance(Vector3 $vector) : float{
		return $this->baseShape->marginalDistance($vector);
	}

	public function getChunksInvolved() : array{
		return $this->baseShape->getChunksInvolved();
	}
}
