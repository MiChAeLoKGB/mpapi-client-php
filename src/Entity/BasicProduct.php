<?php
namespace MPAPI\Entity;

/**
 * Basic product entity
 *
 * @author Martin Hrdlicka <martin.hrdlicka@mall.cz>
 */
class BasicProduct extends AbstractArticleEntity
{

	/**
	 *
	 * @var string
	 */
	const KEY_PRODUCT_ID = 'product_id';

	/**
	 *
	 * @var string
	 */
	const KEY_CATEGORY_ID = 'category_id';

	/**
	 *
	 * @var string
	 */
	const KEY_HAS_VARIANT = 'has_variant';

	/**
	 *
	 * @var string
	 */
	const KEY_VARIANTS_COUNT = 'variants_count';

	/**
	 * Get product ID
	 *
	 * @return integer
	 */
	public function getProductId()
	{
		$retval = 0;
		if (isset($this->data[self::KEY_PRODUCT_ID])) {
			$retval = $this->data[self::KEY_PRODUCT_ID];
		}
		return $retval;
	}

	/**
	 * Get category ID
	 *
	 * @return string
	 */
	public function getCategoryId()
	{
		$retval = '';
		if (isset($this->data[self::KEY_CATEGORY_ID])) {
			$retval = $this->data[self::KEY_CATEGORY_ID];
		}
		return $retval;
	}

	/**
	 * Product has variant
	 *
	 * @return boolean
	 */
	public function hasVariant()
	{
		$retval = false;
		if (isset($this->data[self::KEY_HAS_VARIANT])) {
			$retval = (boolean) $this->data[self::KEY_HAS_VARIANT];
		}
		return $retval;
	}

	/**
	 * Get variants count
	 *
	 * @return integer
	 */
	public function getVariantsCount()
	{
		$retval = 0;
		if (isset($this->data[self::KEY_VARIANTS_COUNT])) {
			$retval = $this->data[self::KEY_VARIANTS_COUNT];
		}
		return $retval;
	}

	/**
	 * @see \MPAPI\Entity\AbstractEntity::getData()
	 */
	public function getData()
	{
		return [
			self::KEY_ID => $this->getId(),
			self::KEY_PRODUCT_ID => $this->getProductId(),
			self::KEY_TITLE => $this->getTitle(),
			self::KEY_CATEGORY_ID => $this->getCategoryId(),
			self::KEY_HAS_VARIANT => $this->hasVariant(),
			self::KEY_VARIANTS_COUNT => $this->getVariantsCount()
		];
	}

	/**
	 * Set product data
	 *
	 * @param array $data
	 * @return BasicProduct
	 */
	public function setData(array $data)
	{
		$this->data = $data;
		return $this;
	}
}
