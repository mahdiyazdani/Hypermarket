# Video popup

This option lets you to embed **YouTube** or **Vimeo** videos on a call to action box using a popup lightbox overlay display.

!> This feature is available only to **Hypermarket Plus** users! [Upgrade now](https://www.mypreview.one).

Video popup section can be adjusted with a few clicks via the WordPress **customizer**. Log into your website and then:

![Video popup](img/video-popup.png)

* On the frontend, in the Admin bar, click **Site Name** » **Customize**.
* On the backend, click **Appearance** » **Customize**.
* Navigate to **Video Popup** section.
* Enter **Youtube** or **Vimeo** page url, video will appear on popup window.
* Adjust the video play button & content **float**.
* Choose a default video button & content **skin mode**.
* Adjust the video play button **position**.
* Upload a custom **background image** for the video popup component.
* Optionally, give a **video description** or content, including HTML.
* **Save & Publish**.

!> You can toggle the visibility and reorder the video popup component position using the [homepage control](homepage control) section.

?> If there are no components displaying in the WordPress customizer for **Video Popup** you may not yet have the default Hypermarket homepage template configured and [set as the front page](setup-homepage-template) of your WordPress site as the **Video Popup** customizer settings will only display if you have this page template set as the front page of your site. 

## Shortcode

You can add the video popup component to any page using the ```[hypermarket-plus-video-popup]``` shortcode. Also, it is possible to pass the following attributes to the shortcode to create custom video elements.

```php
video_url
content_float
alter_appearance
image_id
btn_placement
content
full_width
```

A full shortcode could look like:

```php
[hypermarket-plus-video-popup video_url="https://www.youtube.com/watch?v=D6MQ3Ae4ZB0" content_float="col-lg-6 col-md-7 col-sm-8" alter_appearance="" image_id="2540" btn_placement="after" content="Impressive Look for Your Shop" full_width="off"]
```
![Generate a video popup shortcode](img/generate-video-popup-shortcode.gif)

Alternatively, locate an additional button in TinyMCE’s toolbar – place the cursor where the video popup tooltip will appear, then click the **video popup button**.

After clicking the interface button, a modal dialog with a few options to config will appear, optionally fill the blanks and hit the **OK** button to generate a new video popup shortcode.
