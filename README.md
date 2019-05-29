# Custom Rest Endpoints

A WordPress plugin that serves up WP Rest API endpoints using [Advanced Custom Fields](https://www.advancedcustomfields.com)

## Endpoints

### Home page
**`{URL}/wp-json/pagecontent/v1/home`**
Get the Home page data.

It returns a JSON response with the following:
- ACF fields: 'content_blocks_home'

### Get Posts
**`{URL}/wp-json/posts/v1/archive?per_page={integer}&offset={integer}`**
Gets a collection of posts. Accepts the following parameters:
- per_page (int)
- offset (int)

It returns a JSON response with the following:
- Title
- Image
- Date (timestamp)
- Post Link
- Categories list (array: name & link)

### Get Post by ID
**`{URL}/wp-json/posts/v1/detail/{post_id}`**
Get a post by ID. Accepts the following parameter:
- ID (int)

It returns a JSON response with the following:
- Title
- Image
- Content
- Categories list (array: name & link)

### Categories List
**`{URL}/wp-json/news/v1/categories`**
Get a list of Categories used by WordPress posts. Accepts no parameters.

It returns a JSON response with the following:
- Category Name
- Category ID

### Upcoming Events (custom post type)
**`{URL}/wp-json/posts/v1/upcoming_events`**
Get the 10 Upcoming Events (posts) from now (by date). Accepts no parameters.

It returns a JSON response with the following:
- Title
- Date (timestamp)
- Link

### Books by Genre
**`{URL}/wp-json/books/v1/bygenre`**
Get books grouped by genre, also include an image carousel and general info by genre. Accepts no parameters.

It returns a JSON response with the following:
##### Genre - General info
- Title
- Description
- Image

##### Genre - Image Carousel
- Title
- Description
- Images

##### Posts by Genre
- Image
- Title
- Description
- Link

### Featured Books ordered
**`{URL}/wp-json/books/v1/featured`**
Get the 10 Featured Books ordered. Accepts no parameters.

It returns a JSON response with the following:
- Title
- Description
- Image
- Link
- Order (int)