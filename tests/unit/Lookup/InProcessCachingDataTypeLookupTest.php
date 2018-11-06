<?php

namespace Wikibase\DataModel\Services\Tests\Lookup;

use PHPUnit_Framework_TestCase;
use Wikibase\DataModel\Entity\PropertyId;
use Wikibase\DataModel\Services\Lookup\InProcessCachingDataTypeLookup;
use Wikibase\DataModel\Services\Lookup\PropertyDataTypeLookup;

/**
 * @covers Wikibase\DataModel\Services\Lookup\InProcessCachingDataTypeLookup
 *
 * @license GPL-2.0-or-later
 * @author Katie Filbert < aude.wiki@gmail.com >
 */
class InProcessCachingDataTypeLookupTest extends PHPUnit_Framework_TestCase {

	public function testWhenCacheIsEmpty_decoratedLookupValueIsReturned() {
		$decoratedLookup = $this->createMock( PropertyDataTypeLookup::class );

		$decoratedLookup->expects( $this->once() )
			->method( 'getDataTypeIdForProperty' )
			->with( new PropertyId( 'P1' ) )
			->will( $this->returnValue( 'string' ) );

		$cachingLookup = new InProcessCachingDataTypeLookup( $decoratedLookup );

		$this->assertSame(
			'string',
			$cachingLookup->getDataTypeIdForProperty( new PropertyId( 'P1' ) )
		);
	}

	public function testWhenValueInCache_cacheValueIsReturned() {
		$decoratedLookup = $this->createMock( PropertyDataTypeLookup::class );

		$decoratedLookup->expects( $this->once() )
			->method( 'getDataTypeIdForProperty' )
			->will( $this->returnValue( 'string' ) );

		$cachingLookup = new InProcessCachingDataTypeLookup( $decoratedLookup );
		$cachingLookup->getDataTypeIdForProperty( new PropertyId( 'P1' ) );

		$decoratedLookup->expects( $this->never() )
			->method( 'getDataTypeIdForProperty' );

		$this->assertSame(
			'string',
			$cachingLookup->getDataTypeIdForProperty( new PropertyId( 'P1' ) )
		);
	}

}
