# Custom Rest Endpoints

A WordPress plugin that serves up WP Rest API endpoints using [Advanced Custom Fields](https://www.advancedcustomfields.com)

## Endpoints

### Home page
**`{URL}/wp-json/pagecontent/v1/home`**
Get the Home page data.

It returns a JSON response with the following:
- ACF fields: 'content_blocks_home'

### Categories List
**`{URL}/wp-json/news/v1/categories`**
Get a list of Categories used by WordPress posts. Accepts no parameters.

It returns a JSON response with the following:
- Category Name
- Category ID