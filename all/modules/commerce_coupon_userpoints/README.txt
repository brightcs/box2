------------
Summary
-------------

This Module applies bonus user point coupons when checking out.

2 Types of bonuses (can be compounded in a single coupon):

1. Order Bonus:
When a minimum purchase amount is reached (before tax), x number of userpoints
are awarded to the user.

2. Product Bonus:
When certain products are purchased, a number of points are awarded per each
product in the cart of that type.



-------------
Installation
-------------

1. Install commerce coupon module.
2. Install and configure the userpoints module.
  2.a. Create a taxonomy term in userpoints vocabulary ("Credit" for instance)
  2.b. Go to Store > Config > Commerce points settings
3. Create a coupon for a specific type.



---------------
Coupon Fields
----------------

** Title: The text the user will see in their cart to verify the correct code is
entered.

** Userpoints Type - the type of userpoints to be awarded.

** Order Bonus - Number of Points: The points added to the order if purchase
minimum is met.

** Purchase Minium: The value required to meet before the coupon is valid for
 the order bonus amount.

** Product Bonus - Number of Points: The points awarded for each promo product
in the cart, including multiples of the same item. (i.e. a quantity of 5 of a
single product gets 5x the bonus).

** Eligible Products: the products for which the specified bonus code applies.
Each selected product is independently awarded bonus points.
