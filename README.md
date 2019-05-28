# Custom Rest Endpoints

A WordPress plugin that serves up WP Rest API endpoints using [Advanced Custom Fields](https://www.advancedcustomfields.com)

## Endpoints

### Home page
**`{URL}/wp-json/pagecontent/v1/home`**
Get the Home page data.

It returns a JSON response with the following:
- ACF fields: 'content_blocks_home'

### Post
**`better-rest-endpoints/v1/post/{id}`**
Get a post by ID.

Accepts the following parameters:

- ID (int)

Returns a JSON response with the following:

- ACF fields, if applicable
- all possible thumbnail sizes & URLs
- Author, user_nicename, & Author ID
- Categories
- Category IDs
- content
- date (ISO 8601)
- excerpt
- id
- slug
- Tag IDs
- Tags
- title
- Yoast SEO fields, if applicable

### Post by slug
**`better-rest-endpoints/v1/post/{slug}`**
Get a post by ID.

Accepts the following parameters:

- slug (string)

Returns a JSON response with the following:

- ACF fields, if applicable
- all possible thumbnail sizes & URLs
- Author, user_nicename, & Author ID
- Categories
- Category IDs
- content
- date (ISO 8601)
- excerpt
- id
- slug
- Tag IDs
- Tags
- title
- Yoast SEO fields, if applicable