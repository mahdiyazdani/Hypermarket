# Create product

There are several sorts of products that you can add to your online shop using [WooCommerce](installing-woocommerce.md). In this brief guide, you will find out about the basics of adding a product to your store.

## Type of products

* Simple Product<br/>
*This is a single physical product that has no variations.*
* Simple Product Virtual<br/>
*An example of this would be a service, such as hourly consulting.*
* Simple Product Downloadable<br/>
*This is both virtual and downloadable, such as an ebook or a music file.*
* Grouped Product<br/>
*A collection of products that are related but can be purchased separately. An example would be different models of the iMac from Apple.*
* External or Affiliate Product<br/>
*A product your will add to your store but buyers will be sent to another site to purchase it. Affiliates work well or products you may make a commission on.*
* Variable Product<br/>
*Some products will have different variations and multiple images. For example a t-shirt, that comes in different sizes and colors, with different prices.*

!> Note that some extensions or third-party plugins if installed will add more product date choices, such as **subscriptions**.

## Product categories

[Product categories](managing-product-categories.md) and tags work in much the same way as normal categories and tags you have when writing posts in WordPress. They can be created, edited, and selected at any time. This can be done when you first create a product or come back and edit it or the category/tag specifically.

## Attributes

These can be added per product, or you can set up **global attributes** for the entire store to use (e.g., in layered navigation).

## Adding a simple product

Adding a simple product is similar to [writing a post](create-post.md) in WordPress. Hover over the **Products** menu, then select **Add Product**. You then have a familiar interface and should immediately feel at home.

![Create a product](img/create-product.png)

Under the editor is the Product Type panel. Define the product type (as outlined above) and whether it is a downloadable (digital) or virtual (service) product.

?> Note that virtual products **don’t require shipping** — an order containing virtual products won’t calculate any shipping costs.

## Adding a virtual product

When adding a simple product, you can check the **Virtual** box in the product type panel. This removes unnecessary fields, such as dimensions.

## Adding a downloadable product

When adding a simple product, you can check the **downloadable** box in the product type panel. This adds two new fields:

* **File path** — Path or url to your downloadable file.
* **Download limit** – Limit on number of times the customer can download file. Left blank for unlimited downloads.

?> For maximum flexibility, downloadable products also incur a shipping cost (if, for example, you were offering both a packaged and a downloadable version of a product, this would be ideal). You can also check the **Virtual** box if the downloadable product **is not shippable**.

## Product data

The Product Data meta box is where the majority of important data is added for your products.

![WooCommerce product data meta box](img/woocommerce-product-data.png)

* **SKU** – Stock keep unit (SKU) tracks products. Must be unique and should be formatted so it does not match any post IDs. For example, post IDs are numbers so a SKU could be WS01. That could stand for WooShirt 01.
* **Price** 
  * **Regular Price** – Item’s normal/regular price.
  * **Sale Price** – Item’s discounted price that can then be scheduled for certain date ranges.
* The **inventory section** allows you to manage stock for the product individually and define whether to allow back orders and more. If stock management is disabled from the settings page, only the *Manage stock?* option is visible.
* **Shipping**
  * **Weight** – Weight of the item.
  * **Dimensions** – Length, width and height for the item.
  * **Shipping Class** – Shipping classes are used by certain shipping methods to group similar products.
* Using **up-sells** and **cross-sells**, you can cross promote your products.<br/>
*Up-sells are displayed on the product details page.*<br/>
*Cross-sells are products that are displayed with the cart and related to the user’s cart contents.*

## Catalog visibility

In the **Publish** panel, you can set catalog visibility for your product.

* **Catalog and search** – Visible everywhere, shop pages, category pages, & search results.
* **Catalog** – Visible in shop pages & category pages, but not search results.
* **Search** – Visible in search results, but not in the shop page or category pages.
* **Hidden** – Only visible on the single product page – not on any other pages.
