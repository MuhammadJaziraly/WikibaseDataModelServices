<?php

namespace Wikibase\DataModel\Services\Lookup;

use Wikibase\DataModel\Entity\PropertyId;

/**
 * @since 2.0
 *
 * @licence GNU GPL v2+
 * @author Adam Shorland
 */
class PropertyDataTypeLookupException extends \RuntimeException {

	private $propertyId;

	public function __construct( PropertyId $propertyId, $message = null, \Exception $previous = null ) {
		$this->propertyId = $propertyId;

		parent::__construct(
			$message ?: 'Property data type lookup failed for: ' . $propertyId,
			0,
			$previous
		);
	}

	/**
	 * @return PropertyId
	 */
	public function getPropertyId() {
		return $this->propertyId;
	}

}
