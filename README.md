# Featured Image to DataUrl  for WP-GraphQL

Recently Nextjs Announce support for blur Image placeholder Its a great news for the NextJS comunity. This plugin ads a base64 bataUrl to post Query so you can use it as `blurDataURL` in NextJS.


## Retrieving the Featured Image DataUrl.

To retrieve Featured Image DataUrl, it's a simple case of requesting the `featuredImageDataUrl`. See below:

```js
query MyQuery {
  posts {
    nodes {
      featuredImageDataUrl
    }
  }
}

```

This will then give you a result as such:

```json
{
  "data": {
    "posts": {
      "nodes": [
        {
          "featuredImageDataUrl": "data:image/jpg;base64,/9j/4AAQSkZJRgABAQEAYABgAAD//g.........................."
        },
        {
          "featuredImageDataUrl": null
        }
      ]
    }
  },
}
```



## Contributions

Contributions are welcome. This was a very quick build and I'm very new to PHP.

Feel free to make a PR against this repo!