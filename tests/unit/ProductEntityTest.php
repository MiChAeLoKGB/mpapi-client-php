<?php
namespace MPAPI\Tests\Unit;

use Codeception\Util\Fixtures;
use MPAPI\Entity\Products\Product;
use MPAPI\Entity\Products\Variant;

/**
 * Test product entity
 *
 * @author Jan Blaha <jan.blaha@mall.cz>
 */
class ProductTest extends \Codeception\Test\Unit
{

	/**
	 *
	 * @var Product
	 */
	private $object;

	protected function _before()
	{
		$this->object = new Product(Fixtures::get('product'));
	}

	protected function _after()
	{
		unset($this->object);
	}

	public function testGetId()
	{
		$this->assertNotEmpty($this->object->getId());
	}

	public function testGetArticleId()
	{
		$this->assertNotEmpty($this->object->getArticleId());
	}

	public function testGetTitle()
	{
		$this->assertNotEmpty($this->object->getTitle());
	}

	public function testGetCategoryId()
	{
		$this->assertNotEmpty($this->object->getCategoryId());
	}

	public function testGetDeliveryDelay()
	{
		$this->assertNotEmpty($this->object->getDeliveryDelay());
	}

	public function testGetUrl()
	{
		$this->assertNotEmpty($this->object->getUrl());
	}

	public function testGetShortdesc()
	{
		$this->assertNotEmpty($this->object->getShortdesc());
	}

	public function testGetLongdesc()
	{
		$this->assertNotEmpty($this->object->getLongdesc());
	}

	public function testGetBrandId()
	{
		$this->assertNotEmpty($this->object->getBrandId());
	}

	public function testGetPriority()
	{
		$this->assertNotEmpty($this->object->getPriority());
	}

	public function testGetBarcode()
	{
		$this->assertEmpty($this->object->getBarcode());
	}

	public function testGetPrice()
	{
		$this->assertEmpty($this->object->getPrice());
	}

	public function testGetVat()
	{
		$this->assertNotEmpty($this->object->getVat());
	}

	public function testGetRrpPrice()
	{
		$this->assertEmpty($this->object->getRrpPrice());
	}

	public function testGetEmptyVariants()
	{
		$this->assertEmpty($this->object->getVariants());
	}

	public function testGetData()
	{
		$this->assertNotEmpty($this->object->getData());
	}

	public function testAddVariant()
	{
		$this->object->addVariant(new Variant(Fixtures::get('variantData')));
		$this->assertNotEmpty($this->object->getVariants());
	}

	public function testEmptyMedia()
	{
		$this->assertEmpty($this->object->getMedia());
	}

	public function testMainMedia()
	{
		$media = Fixtures::get('media');
		$expectedMedia = Fixtures::get('mainMedia');
		$this->object->setMedia([]);
		$this->assertEmpty($this->object->getMedia());
		$this->object->addMedia($media[0]['url'], $media[0]['main']);
		$this->assertEquals($expectedMedia, current($this->object->getMedia()));
	}

	public function testOrdinaryMedia()
	{
		$media = Fixtures::get('media');
		$expectedMedia = Fixtures::get('ordinaryMedia');
		$this->object->setMedia([]);
		$this->assertEmpty($this->object->getMedia());
		$this->object->addMedia($media[1]['url']);
		$this->assertEquals($expectedMedia, current($this->object->getMedia()));
	}

	public function testAddParameter()
	{
		$this->assertNotContains('MP_COLOR', array_keys($this->object->getParameters()));
		// add parameter MP_COLOR
		$this->object->addParameter('MP_COLOR', 'blue');
		$this->assertContains('MP_COLOR', array_keys($this->object->getParameters()));
	}

	public function testRemoveParameter()
	{
		$this->object->addParameter('MP_COLOR', 'blue');
		$this->assertContains('MP_COLOR', array_keys($this->object->getParameters()));
		$this->object->removeParameter('MP_COLOR');
		$this->assertNotContains('MP_COLOR', array_keys($this->object->getParameters()));
	}

	public function testGetRecommended()
	{
		$this->assertEmpty($this->object->getRecommended());
	}

	public function testAddRecommended()
	{
		$this->assertEmpty($this->object->getRecommended());
		$this->object->addRecommended([
			'cdcept-v0123'
		]);
		$this->assertNotEmpty($this->object->getRecommended());
	}

	public function testGetAvailability()
	{
		$this->assertContains('status', array_keys($this->object->getAvailability()));
		$this->assertContains('in_stock', array_keys($this->object->getAvailability()));
	}

	public function testGetLabels()
	{
		$this->assertNotEmpty($this->object->getLabels());
	}

	public function testSetLabels()
	{
		$this->object->setLabels([]);
		$this->assertEmpty($this->object->getLabels());
		$this->object->setLabels([
			'label' => 'NEW',
			'from' => '2018-01-01 00:00:00',
			'to' => '2020-03-01 00:00:00'
		]);
		$this->assertNotEmpty($this->object->getLabels());
	}

	public function testAddLabel()
	{
		$this->object->addLabel('SALE', '2016-12-31 00:00:00', '2020-12-31 00:00:00');
		$labels = $this->object->getLabels();

		$found = false;
		foreach ($labels as $label) {
			if ($label['label'] == 'SALE') {
				$found = true;
				break;
			}
		}

		$this->assertTrue($found);
	}

	public function testHasFreeDelivery()
	{
		$this->assertFalse($this->object->hasFreeDelivery());
	}

	public function testSetFreeDelivery()
	{
		$this->object->setFreeDelivery(true);
		$this->assertTrue($this->object->hasFreeDelivery());
	}
}
