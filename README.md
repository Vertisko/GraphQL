### Queries

This project use 2 mains types : `Channel` and `ChannelGroup`  

Here is an example of a graphQL query :

```graphql
{
  channels(first: 2){
    edges
    {
      cursor
      node{
        name
        activated
        channelGroup{
          name
        }
      }
    }
  }
}
```

