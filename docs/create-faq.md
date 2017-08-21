# Create FAQs

[Hypermarket Plus](https://www.mypreview.one) has inbuilt support for FAQ custom post type. Use this post type to easily create, order and publicize FAQs and display the questions in groups by tagging them, and even load them closed or readily open.

!> This feature is available only to **Hypermarket Plus** users! [Upgrade now](https://www.mypreview.one).

## Adding FAQs

Similar to posts in WordPress, you can **add, delete, and edit** your FAQ items here.

![Adding FAQs](img/add-faq.png)

* Navigate to the **FAQ** tab.
* Click the **Add New** button in the top left-hand corner of the page.
* Add a **Title**.<br/>
*This will appear as a FAQ’s question.*
* Enter a **description** or custom content.<br/>
*This will appear as a FAQ’s answer.*
* As needed, select a **Group** for question.
* **Publish** or **Update** the item.

## Shortcode

You can add the FAQ component to any page and product using the ```[hypermarket-plus-faq]``` shortcode. Also, it is possible to pass the following attributes to the shortcode to create custom hero elements.

```php
group_id
collapse
order
orderby
limit
```

A full shortcode could look like:

```php
[hypermarket-plus-faq group_id="4" collapse="in" order="DESC" orderby="none" limit=""]
```

![Generate a FAQ shortcode](img/generate-faq-shortcode.gif)

Alternatively, locate an additional button in TinyMCE’s toolbar – place the cursor where the FAQ tooltip will appear, then click the **FAQ button**.

After clicking the interface button, a modal dialog with a few options to config will appear, optionally fill the blanks and hit the **OK** button to generate a new FAQ shortcode.
