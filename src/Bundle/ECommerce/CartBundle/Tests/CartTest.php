<?php

namespace Bundle\ECommerce\CartBundle\Tests\Document;

use Application\ECommerceBundle\Tests\TestCase\TestCase;

use Bundle\ECommerce\CartBundle\Document\Cart;
use Bundle\ECommerce\CartBundle\Document\CartProduct;
use Bundle\ECommerce\CartBundle\Document\CartProductOption;

use Bundle\ECommerce\ProductBundle\Document\Product;

class CartTest extends TestCase
{
    public function testCart()
    {
        $dm = $this->getDm();
        $this->loadMongoDBDataFixtures();

        $cart = $dm->getRepository('Bundle\ECommerce\CartBundle\Document\Cart')->findAll()->getSingleResult();

        $dm->persist($cart);
        $dm->flush();
        
        $this->assertTrue( (string) $cart->getCartProducts()->get(0)->getOptions()->get(0) == 'color 1: red');
        $this->assertTrue($cart->getCartProducts()->get(0)->getOptions()->get(0)->getValue() == 'red');
    }
}

