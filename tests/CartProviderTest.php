<?php
use Syscover\ShoppingCart\Facades\CartProvider;
use Syscover\ShoppingCart\Cart;
use Syscover\ShoppingCart\Item;
use Syscover\ShoppingCart\TaxRule;
use Syscover\ShoppingCart\PriceRule;

require_once __DIR__ . '/shopping_cart_tests_helpers/SessionMock.php';
require_once __DIR__ . '/shopping_cart_tests_helpers/ProductModelStub.php';
require_once __DIR__ . '/shopping_cart_tests_helpers/NamespacedProductModelStub.php';

class CartProviderTest extends TestCase
{
    public function testCartCanAdd()
    {
        $this->expectsEvents('cart.added');

        CartProvider::instance()->add(new Item('293ad', 'Product 1', 1, 9.99, 1.000, true));

        $this->assertEquals(1, CartProvider::instance()->getCartItems()->count());
    }

    public function testCartCanAddWithOptions()
    {
        $this->expectsEvents('cart.added');

        CartProvider::instance()->add(new Item('293ad', 'Product 1', 1, 9.99, 1.000, true, [], ['size' => 'L']));
    }

    public function testCartCanAddMultipleCartItems()
    {
        $this->expectsEvents('cart.added');

        CartProvider::instance()->add([
            new Item('293ad', 'Product 1', 1, 9.99, 1.000, true),
            new Item('283ad', 'Product 2', 3, 10.00, 1.000, true),
            new Item('244ad', 'Product 3', 2, 20.50, 1.000, true)
        ]);

        $this->assertEquals(3, CartProvider::instance()->getCartItems()->count());

    }

    public function testCartCanAddWithTaxRule()
    {
        $this->expectsEvents('cart.added');

        CartProvider::instance()->add(new Item('293ad', 'Product 1', 1, 9.99, 1.000, true, new TaxRule('VAT', 21.00)));

        $this->assertEquals(1, CartProvider::instance()->getCartItems()->first()->taxRules->count());
        $this->assertEquals(21, CartProvider::instance()->getCartItems()->first()->taxRules->first()->taxRate);
        $this->assertEquals(['21'], CartProvider::instance()->getCartItems()->first()->getTaxRates());
    }

    public function testCartCanAddWithTaxRules()
    {
        $this->expectsEvents('cart.added');

        CartProvider::instance()->add(new Item('293ad', 'Product 1', 1, 100, 1.000, true, [
            new TaxRule('IVA', 21.00, 0, 0),
            new TaxRule('OTHER IVA', 10.00, 1, 1)
        ]));

        $this->assertEquals(2, CartProvider::instance()->getCartItems()->first()->taxRules->count());

        if(config('shoppingcart.taxProductPrices') == Cart::PRICE_WITHOUT_TAX)
        {
            $this->assertEquals('100,00', CartProvider::instance()->getCartItems()->first()->getSubtotal());
            $this->assertEquals(100.00, CartProvider::instance()->getCartItems()->first()->subtotal);
            $this->assertEquals('33,10', CartProvider::instance()->getCartItems()->first()->getTaxAmount());
            $this->assertEquals('133,10', CartProvider::instance()->getCartItems()->first()->getTotal());
            $this->assertEquals(133.100, CartProvider::instance()->getCartItems()->first()->total);

            $this->assertEquals('21,00', CartProvider::instance()->getTaxRules()->get(md5('IVA' . '0'))->getTaxAmount());
            $this->assertEquals(['21'], CartProvider::instance()->getTaxRules()->get(md5('IVA' . '0'))->getTaxRate());
            $this->assertEquals('IVA', CartProvider::instance()->getTaxRules()->get(md5('IVA' . '0'))->name);

            $this->assertEquals('12,10', CartProvider::instance()->getTaxRules()->get(md5('OTHER IVA' . '1'))->getTaxAmount());
            $this->assertEquals('10', CartProvider::instance()->getTaxRules()->get(md5('OTHER IVA' . '1'))->getTaxRate());
            $this->assertEquals('OTHER IVA', CartProvider::instance()->getTaxRules()->get(md5('OTHER IVA' . '1'))->name);
        }
        elseif(config('shoppingcart.taxProductPrices') == Cart::PRICE_WITH_TAX)
        {
            $this->assertEquals('75,13', CartProvider::instance()->getCartItems()->first()->getSubtotal());
            $this->assertEquals(75.1314800901577797276331693865358829498291015625, CartProvider::instance()->getCartItems()->first()->subtotal);
            $this->assertEquals('24,87', CartProvider::instance()->getCartItems()->first()->getTaxAmount());
            $this->assertEquals('100,00', CartProvider::instance()->getCartItems()->first()->getTotal());
            $this->assertEquals(100, CartProvider::instance()->getCartItems()->first()->total);

            $this->assertEquals('15,78', CartProvider::instance()->getTaxRules()->get(md5('IVA' . '0'))->getTaxAmount());
            $this->assertEquals('21', CartProvider::instance()->getTaxRules()->get(md5('IVA' . '0'))->getTaxRate());
            $this->assertEquals('IVA', CartProvider::instance()->getTaxRules()->get(md5('IVA' . '0'))->name);

            $this->assertEquals('9,09', CartProvider::instance()->getTaxRules()->get(md5('OTHER IVA' . '1'))->getTaxAmount());
            $this->assertEquals('10', CartProvider::instance()->getTaxRules()->get(md5('OTHER IVA' . '1'))->getTaxRate());
            $this->assertEquals('OTHER IVA', CartProvider::instance()->getTaxRules()->get(md5('OTHER IVA' . '1'))->name);
        }
    }

    public function testCartCanAddWithSameTaxRules()
    {
        $this->expectsEvents('cart.added');

        CartProvider::instance()->add(new Item('293ad', 'Product 1', 1, 110.99, 1.000, true, [
            new TaxRule('VAT', 21.00),
            new TaxRule('VAT', 10.00)
        ]));

        $this->assertEquals(1, CartProvider::instance()->getCartItems()->first()->taxRules->count());
        $this->assertEquals(31, CartProvider::instance()->getCartItems()->first()->taxRules->first()->taxRate);
        $this->assertEquals(['31'], CartProvider::instance()->getCartItems()->first()->getTaxRates());

        if(config('shoppingcart.taxProductPrices') == Cart::PRICE_WITHOUT_TAX)
        {
            $this->assertEquals('110,99', CartProvider::instance()->getCartItems()->first()->getSubtotal());
            $this->assertEquals(110.99, CartProvider::instance()->getCartItems()->first()->subtotal);
            $this->assertEquals('34,41', CartProvider::instance()->getCartItems()->first()->getTaxAmount());
            $this->assertEquals('145,40', CartProvider::instance()->getCartItems()->first()->getTotal());
            $this->assertEquals(145.396899999999988040144671685993671417236328125, CartProvider::instance()->getCartItems()->first()->total);
        }
        elseif(config('shoppingcart.taxProductPrices') == Cart::PRICE_WITH_TAX)
        {
            $this->assertEquals('84,73', CartProvider::instance()->getCartItems()->first()->getSubtotal());
            $this->assertEquals(84.7251908396946618040601606480777263641357421875, CartProvider::instance()->getCartItems()->first()->subtotal);
            $this->assertEquals('26,26', CartProvider::instance()->getCartItems()->first()->getTaxAmount());
            $this->assertEquals('110,99', CartProvider::instance()->getCartItems()->first()->getTotal());
            $this->assertEquals(110.99, CartProvider::instance()->getCartItems()->first()->total);
        }
    }

    public function testCartCanAddWithTaxRulesWithDifferentPrioritiesAndDiscountSubtotalPercentage()
    {
        $this->expectsEvents('cart.added');

        CartProvider::instance()->add(new Item('293ad', 'Product 1', 1, 100, 1.000, true, [
            new TaxRule('IVA', 21.00, 0, 0),
            new TaxRule('OTHER IVA', 10.00, 1, 1)
        ]));

        CartProvider::instance()->addCartPriceRule(
            new PriceRule(
                'My first price rule',
                'For being a good customer',
                PriceRule::DISCOUNT_SUBTOTAL_PERCENTAGE,
                true,
                10.00
            )
        );

        $this->assertEquals(2, CartProvider::instance()->getCartItems()->first()->taxRules->count());

        if(config('shoppingcart.taxProductPrices') == Cart::PRICE_WITHOUT_TAX)
        {
            $this->assertEquals('100,00', CartProvider::instance()->getCartItems()->first()->getSubtotal());
            $this->assertEquals(100.00, CartProvider::instance()->getCartItems()->first()->subtotal);
            $this->assertEquals('33,10', CartProvider::instance()->getCartItems()->first()->getTaxAmount());
            $this->assertEquals('133,10', CartProvider::instance()->getCartItems()->first()->getTotal());
            $this->assertEquals(133.100, CartProvider::instance()->getCartItems()->first()->total);

            $this->assertEquals('21,00', CartProvider::instance()->getTaxRules()->get(md5('IVA' . '0'))->getTaxAmount());
            $this->assertEquals('21', CartProvider::instance()->getTaxRules()->get(md5('IVA' . '0'))->getTaxRate());
            $this->assertEquals('IVA', CartProvider::instance()->getTaxRules()->get(md5('IVA' . '0'))->name);

            $this->assertEquals('12,10', CartProvider::instance()->getTaxRules()->get(md5('OTHER IVA' . '1'))->getTaxAmount());
            $this->assertEquals('10', CartProvider::instance()->getTaxRules()->get(md5('OTHER IVA' . '1'))->getTaxRate());
            $this->assertEquals('OTHER IVA', CartProvider::instance()->getTaxRules()->get(md5('OTHER IVA' . '1'))->name);
        }

        if(config('shoppingcart.taxProductPrices') == Cart::PRICE_WITH_TAX)
        {
            $this->assertEquals('75,13', CartProvider::instance()->getCartItems()->first()->getSubtotal());
            $this->assertEquals(75.1314800901577797276331693865358829498291015625, CartProvider::instance()->getCartItems()->first()->subtotal);

            $this->assertEquals(10, CartProvider::instance()->getCartItems()->first()->discountSubtotalPercentage);
            $this->assertEquals('10', CartProvider::instance()->getCartItems()->first()->getDiscountSubtotalPercentage());
            $this->assertEquals(7.51314800902, CartProvider::instance()->getCartItems()->first()->discountAmount);
            $this->assertEquals('7,51', CartProvider::instance()->getCartItems()->first()->getDiscountAmount());

            $this->assertEquals('22,38', CartProvider::instance()->getCartItems()->first()->getTaxAmount());

            $this->assertEquals('90,00', CartProvider::instance()->getCartItems()->first()->getTotal());
            $this->assertEquals(90, CartProvider::instance()->getCartItems()->first()->total);

            $this->assertEquals('14,20', CartProvider::instance()->getTaxRules()->get(md5('IVA' . '0'))->getTaxAmount());
            $this->assertEquals('21', CartProvider::instance()->getTaxRules()->get(md5('IVA' . '0'))->getTaxRate());
            $this->assertEquals('IVA', CartProvider::instance()->getTaxRules()->get(md5('IVA' . '0'))->name);

            $this->assertEquals('8,18', CartProvider::instance()->getTaxRules()->get(md5('OTHER IVA' . '1'))->getTaxAmount());
            $this->assertEquals('10', CartProvider::instance()->getTaxRules()->get(md5('OTHER IVA' . '1'))->getTaxRate());
            $this->assertEquals('OTHER IVA', CartProvider::instance()->getTaxRules()->get(md5('OTHER IVA' . '1'))->name);
        }
    }

    public function testCartCanAddMultiple()
    {
        $this->expectsEvents('cart.added');

        for($i = 1; $i <= 5; $i++)
            CartProvider::instance()->add(new Item('293ad' . $i, 'Product', 2, 9.99, 1.000, true));

        $this->assertEquals(5, CartProvider::instance()->getCartItems()->count());
        $this->assertEquals(10, CartProvider::instance()->getQuantity());
    }

    public function testCartCanAddWithNumericId()
    {
        $this->expectsEvents('cart.added');

        CartProvider::instance()->add(new Item(12345, 'Product', 2, 9.99, 1.000, true));
    }
}
