<?php
namespace Pim\Bundle\ProductBundle\Tests\Unit\Entity;

use Pim\Bundle\ProductBundle\Entity\ProductAttribute;

/**
 * Test related class
 *
 * @author    Romain Monceau <romain@akeneo.com>
 * @copyright 2012 Akeneo SAS (http://www.akeneo.com)
 * @license   http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 *
 */
class ProductAttributeTest extends \PHPUnit_Framework_TestCase
{

    /**
     * Test related method
     */
    public function testConstruct()
    {
        $productAttribute = new ProductAttribute();
        $this->assertInstanceOf('Pim\Bundle\ProductBundle\Entity\ProductAttribute', $productAttribute);
    }

    /**
     * Test getter/setter for name property
     */
    public function testGetSetName()
    {
        $productAttribute = new ProductAttribute();
        $this->assertEmpty($productAttribute->getName());

        // Change value and assert new
        $newName = 'test-name';
        $productAttribute->setName($newName);
        $this->assertEquals($newName, $productAttribute->getName());
    }

    /**
     * Test getter/setter for description property
     */
    public function testGetSetDescription()
    {
        $productAttribute = new ProductAttribute();
        $this->assertEmpty($productAttribute->getDescription());

        // Change value and assert new
        $newDescription = 'test-description';
        $productAttribute->setDescription($newDescription);
        $this->assertEquals($newDescription, $productAttribute->getDescription());
    }

    /**
     * Test getter/setter for variant property
     */
    public function testGetSetVariant()
    {
        $productAttribute = new ProductAttribute();
        $this->assertEmpty($productAttribute->getVariant());

        // change value and assert new
        $newVariant = 'test-variant';
        $productAttribute->setVariant($newVariant);
        $this->assertEquals($newVariant, $productAttribute->getVariant());
    }

    /**
     * Test getter/setter for smart property
     */
    public function testGetSetSmart()
    {
        $productAttribute = new ProductAttribute();
        $this->assertFalse($productAttribute->getSmart());

        // change value and assert new
        $newSmart = true;
        $productAttribute->setSmart($newSmart);
        $this->assertTrue($productAttribute->getSmart());
    }
}
