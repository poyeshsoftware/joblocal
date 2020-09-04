---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost:8000/docs/collection.json)

<!-- END_INFO -->

#Todos management

APIs for managing Todos
authenticated false
<!-- START_4fabf3ee5456fd3e57cef0111294ac1f -->
## Get List of Todos
[Insert optional longer description of the API endpoint here.]

> Example request:

```bash
curl -X GET \
    -G "http://localhost:8000/api/v1/todos?is_completed=nihil" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/api/v1/todos"
);

let params = {
    "is_completed": "nihil",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "data": [
        {
            "title": "first  todo updated",
            "is_completed": 0
        },
        {
            "title": "second todo",
            "is_completed": 0
        },
        {
            "title": "third  todo",
            "is_completed": 0
        },
        {
            "title": "fourth  todo",
            "is_completed": 1
        }
    ],
    "links": {
        "first": "http:\/\/localhost:8000\/api\/v1\/todos?page=1",
        "last": "http:\/\/localhost:8000\/api\/v1\/todos?page=1",
        "prev": null,
        "next": null
    },
    "meta": {
        "current_page": 1,
        "from": 1,
        "last_page": 1,
        "path": "http:\/\/localhost:8000\/api\/v1\/todos",
        "per_page": 10,
        "to": 4,
        "total": 4
    }
}
```

### HTTP Request
`GET api/v1/todos`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `is_completed` |  optional  | boolean optional Field to filter by if they have been done or not

<!-- END_4fabf3ee5456fd3e57cef0111294ac1f -->

<!-- START_b773ac6c84efab8cfb720c3ce9d4758a -->
## Create a Todo

> Example request:

```bash
curl -X POST \
    "http://localhost:8000/api/v1/todos" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"title":"quas"}'

```

```javascript
const url = new URL(
    "http://localhost:8000/api/v1/todos"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "quas"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (201):

```json
{
    "data": {
        "id": 3,
        "title": "neww  todo",
        "is_completed": null
    }
}
```
> Example response (422):

```json
{
    "title": [
        "The title field is required."
    ]
}
```

### HTTP Request
`POST api/v1/todos`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `title` | string |  required  | The title of the todo.
    
<!-- END_b773ac6c84efab8cfb720c3ce9d4758a -->

<!-- START_20b0351af32e17d55d847f843f883a9c -->
## Update a Todo Item

> Example request:

```bash
curl -X PATCH \
    "http://localhost:8000/api/v1/todos/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"title":"assumenda","is_completed":false}'

```

```javascript
const url = new URL(
    "http://localhost:8000/api/v1/todos/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "title": "assumenda",
    "is_completed": false
}

fetch(url, {
    method: "PATCH",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
1
```
> Example response (422):

```json
{
    "title": [
        "The title field is required."
    ],
    "is_completed": [
        "The is completed field is required."
    ]
}
```

### HTTP Request
`PATCH api/v1/todos/{id:[0-9]+}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id of todo that you want to update
#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `title` | string |  required  | The title of the todo.
        `is_completed` | boolean |  required  | The state if tge todo, if it has been done or not
    
<!-- END_20b0351af32e17d55d847f843f883a9c -->

<!-- START_983c44cf4ecafacbb13314c0b82ded56 -->
## Remove a Todo Item

> Example request:

```bash
curl -X DELETE \
    "http://localhost:8000/api/v1/todos/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8000/api/v1/todos/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
1
```

### HTTP Request
`DELETE api/v1/todos/{id:[0-9]+}`

#### URL Parameters

Parameter | Status | Description
--------- | ------- | ------- | -------
    `id` |  required  | id of todo that you want to remove

<!-- END_983c44cf4ecafacbb13314c0b82ded56 -->


