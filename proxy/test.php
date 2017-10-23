<?php

 //echo "<pre >";
  // session_start();
  require __DIR__.'/vendor/autoload.php';
  use phpish\shopify;

  require __DIR__.'/conf.php';
  //require __DIR__.'../app/include/DBConnection.php';

  $shop = 'adrianapp.myshopify.com';
  $token = '259d89077f1fd17fc3b9a073a5155e34';

  $shopify= shopify\client($shop, SHOPIFY_APP_API_KEY, $token);





  try
  {
    
     $checkout = array(
            'checkout' => array(
                'line_items' => array(
                     array(
                        'variant_id' => 39943694474,
                        'quantity' => 1
                        )
                    )
                )
            );
     $daata = $shopify('GET /admin/products.json');
     echo "<pre>";
     print_r($daata);
     echo "</pre>";
  }

  catch (shopify\ApiException $e)
  {
  	echo $e;
  	echo "<pre>";
  	print_r($e->getRequest());
  	print_r($e->getResponse());
  }
  catch (shopify\CurlException $e)
  {
      # cURL error
  	echo $e;
  	echo "<pre>";
  	print_r($e->getRequest());
  	print_r($e->getResponse());
  }
?>
<script src="https://sdks.shopifycdn.com/js-buy-sdk/v0/latest/shopify-buy.umd.polyfilled.min.js"></script>
<script type="text/javascript">
  const shopClient = ShopifyBuy.buildClient({
    accessToken: '259d89077f1fd17fc3b9a073a5155e34',
    appId: '6',
    domain: 'adrianapp.myshopify.com'
  });

  var cart;
  shopClient.createCart().then(function (newCart) {
    cart = newCart;

    var variant = {
      'product_id' : '10364597066',
      'title'      : 'Black/red',
      'price'      : 7.00,
      'image'      : '',
      'grams'      : '',
      'variant_id' : '39943694474'
    }
    cart.createLineItemsFromVariants({variant: variant, quantity: 1}).then(function (cart) {
      console.log('cart',cart);
  // do something with updated cart
});
});

  shopClient.fetchProduct('10364597066')
  .then(function (product) {
    console.log(product);
  })
  .catch(function () {
    console.log('Request failed');
  });
</script>