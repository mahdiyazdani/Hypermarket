# Create team members

[Hypermarket Plus](https://www.mypreview.one) has inbuilt support for team members custom post type. Use this post type to easily create, team profile management system for [Hypermarket theme](http://demo.mypreview.one/hypermarket/about). Load in your team members and display their profiles via a shortcode.

!> This feature is available only to **Hypermarket Plus** users! [Upgrade now](https://www.mypreview.one).

## Shortcode

You can add the team members component to any page using the ```[hypermarket-plus-team]``` shortcode. Also, it is possible to pass the following attributes to the shortcode to create custom team members elements.

```php
col
order
orderby
limit
```

A full shortcode could look like:

```php
[hypermarket-plus-team col="4" order="DESC" orderby="none" limit="4"]
```

![Generate a team members shortcode](img/generate-team-members-shortcode.gif)

Alternatively, locate an additional button in TinyMCE’s toolbar – place the cursor where the team members tooltip will appear, then click the **Team button**.

After clicking the interface button, a modal dialog with a few options to config will appear, optionally fill the blanks and hit the **OK** button to generate a new team members shortcode.
