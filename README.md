# Quantoo API

- [Quantoo API](#quantoo-api)
  - [Development setup](#development-setup)
    - [Prerequisites](#prerequisites)
    - [Setup](#setup)
    - [Database with Docker](#database-with-docker)
  - [API calls](#api-calls)
    - [POST: /book](#post-book)
      - [Implementation notes](#implementation-notes)
      - [Parameters](#parameters)
      - [Response Messages](#response-messages)
    - [POST: /book/{id}](#post-bookid)
      - [Implementation notes](#implementation-notes-1)
      - [Parameters](#parameters-1)
      - [Response Messages](#response-messages-1)
    - [POST: /author](#post-author)
      - [Implementation notes](#implementation-notes-2)
      - [Parameters](#parameters-2)
      - [Response Messages](#response-messages-2)
    - [GET: /books/{number}](#get-booksnumber)
      - [Implementation notes](#implementation-notes-3)
      - [Parameters](#parameters-3)
      - [Response Messages](#response-messages-3)
    - [GET: /author/{name}](#get-authorname)
      - [Implementation notes](#implementation-notes-4)
      - [Parameters](#parameters-4)
      - [Response Messages](#response-messages-4)
    - [GET: /author/{id}/books](#get-authoridbooks)
      - [Implementation notes](#implementation-notes-5)
      - [Parameters](#parameters-5)
      - [Response Messages](#response-messages-5)
    - [DELETE: /books/{id}](#delete-booksid)
      - [Implementation notes](#implementation-notes-6)
      - [Parameters](#parameters-6)
      - [Response Messages](#response-messages-6)
    - [DELETE: /author/{id}](#delete-authorid)
      - [Implementation notes](#implementation-notes-7)
      - [Parameters](#parameters-7)
      - [Response Messages](#response-messages-7)


## Development setup

### Prerequisites

- PHP ^7.4.*
- Composer
- MariaDB Database
- Docker (optionally)

### Setup

First, copy the `.env.example` file and rename it to `.env`.
Customize the .env file to suit your needs and continue with:

```sh
> composer install
> php artisan key:generate --ansi
> php artisan migrate:fresh
> php artisan serve
```

If you want the server to be available on the local network, use:

```sh
> php artisan serve --host=<IP>:8000
```

### Database with Docker

The file to create the database is already prepared (docker-compose.yml), you just need to run it:

```bash
> docker compose up
```

At `http://127.0.0.1:8080/` you will find the phpmyadmin control panel.

## API calls

> All queries to the API must start with `/api`, e.g. `127.0.0.1:8000/api/book`.

### POST: /book

#### Implementation notes

This endpoint creates book.

Response Content Type: `application/json`

#### Parameters

| Parameter          | Value    | Parameter type | Data type |
| ------------------ | -------- | -------------- | --------- |
| title              | Required | Query          | String    |
| publisher          | Required | Query          | String    |
| pages              | Required | Query          | Number    |
| author_id          | Required | Query          | Number    |
| publicly_available | Required | Query          | Boolean   |

#### Response Messages

<table>

<tr>
<th>Parameter</th>
<th>Reason</th>
<th>Response</th>
</tr>

<tr>
<td>

**200**

</td>
<td>Book successfully created.</td>
<td>

```json
{
    "message": "Book created.",
    "book": {
        "title": "Witcher",
        "publisher": "Aadsad",
        "pages": "2137",
        "author_id": "2",
        "publicly_available": "0",
        "updated_at": "2023-01-31T13:12:28.000000Z",
        "created_at": "2023-01-31T13:12:28.000000Z",
        "id": 2
    }
}
```

</td>
</tr>

</table>

### POST: /book/{id}

#### Implementation notes

This endpoint updates book.

Response Content Type: `application/json`

#### Parameters

| Parameter          | Value    | Parameter type | Data type |
| ------------------ | -------- | -------------- | --------- |
| title              | Optional | Query          | String    |
| publisher          | Optional | Query          | String    |
| pages              | Optional | Query          | Number    |
| author_id          | Optional | Query          | Number    |
| publicly_available | Optional | Query          | Boolean   |
| id                 | Required | Path           | Number    |

#### Response Messages

<table>

<tr>
<th>Parameter</th>
<th>Reason</th>
<th>Response</th>
</tr>

<tr>
<td>

**200**

</td>
<td>Book successfully updated.</td>
<td>

```json
{
    "message": "Book updated successfully."
}
```

</td>
</tr>

</table>

### POST: /author

#### Implementation notes

This endpoint creates author.

Response Content Type: `application/json`

#### Parameters

| Parameter | Value    | Parameter type | Data type |
| --------- | -------- | -------------- | --------- |
| name      | Required | Query          | String    |
| country   | Required | Query          | String    |

#### Response Messages

<table>

<tr>
<th>Parameter</th>
<th>Reason</th>
<th>Response</th>
</tr>

<tr>
<td>

**200**

</td>
<td>Author successfully created.</td>
<td>

```json
{
    "message": "Author created.",
    "author": {
        "name": "aaa",
        "country": "Poland",
        "updated_at": "2023-01-31T12:53:52.000000Z",
        "created_at": "2023-01-31T12:53:52.000000Z",
        "id": 2
    }
}
```

</td>
</tr>

</table>

### GET: /books/{number}

#### Implementation notes

This endpoint returns the specified number of books, `0` means returning all of them.

Response Content Type: `application/json`

#### Parameters

| Parameter | Value    | Parameter type | Data type |
| --------- | -------- | -------------- | --------- |
| number    | Required | Path           | Number    |

#### Response Messages

<table>

<tr>
<th>Parameter</th>
<th>Reason</th>
<th>Response</th>
</tr>

<tr>
<td>

**200**

</td>
<td>Successfully returned a certain number of books.</td>
<td>

```json
[
    {
        "id": 1,
        "title": "Lord of the rings",
        "publisher": "AaAaa",
        "pages": 234,
        "author_id": 1,
        "created_at": null,
        "updated_at": null
    }
]
```
</td>
</tr>

</table>

### GET: /author/{name}

#### Implementation notes

This endpoint returns 5 authors matching the given name.

Response Content Type: `application/json`

#### Parameters

| Parameter | Value    | Parameter type | Data type |
| --------- | -------- | -------------- | --------- |
| name      | Required | Path           | String    |

#### Response Messages

<table>

<tr>
<th>Parameter</th>
<th>Reason</th>
<th>Response</th>
</tr>

<tr>
<td>

**200**

</td>
<td>Successfully returned authors matching the given name.</td>
<td>

```json
[
    [
        {
            "id": 1,
            "name": "Julian Tuwim",
            "country": "Poland",
            "created_at": "2023-01-31T12:51:43.000000Z",
            "updated_at": "2023-01-31T12:51:43.000000Z"
        }
    ]
]
```
</td>
</tr>

<tr>
<td>

**400**

</td>
<td>This action accepts 3 or more characters.</td>
<td>

```json
{
    "message": "This action accepts 3 or more characters."
}
```
</td>
</tr>

</table>

### GET: /author/{id}/books

#### Implementation notes

This endpoint returns books by a specific author.

Response Content Type: `application/json`

#### Parameters

| Parameter | Value    | Parameter type | Data type |
| --------- | -------- | -------------- | --------- |
| id        | Required | Path           | String    |

#### Response Messages

<table>

<tr>
<th>Parameter</th>
<th>Reason</th>
<th>Response</th>
</tr>

<tr>
<td>

**200**

</td>
<td>Successfully returned books by a specific author.</td>
<td>

```json
[
    [
        {
            "id": 1,
            "title": "Witcher",
            "publisher": "Aadsad",
            "pages": 2137,
            "author_id": 2,
            "publicly_available": 1,
            "created_at": "2023-01-31T13:12:07.000000Z",
            "updated_at": "2023-01-31T13:12:07.000000Z"
        },
        {
            "id": 2,
            "title": "Witcher",
            "publisher": "123ab",
            "pages": 2137,
            "author_id": 2,
            "publicly_available": 0,
            "created_at": "2023-01-31T13:12:28.000000Z",
            "updated_at": "2023-01-31T13:24:16.000000Z"
        }
    ]
]
```
</td>
</tr>

<tr>
<td>

**400**

</td>
<td>ID cannot be less than zero.</td>
<td>

```json
{
    "message": "ID cannot be less than zero."
}
```
</td>
</tr>

</table>

### DELETE: /books/{id}

#### Implementation notes

This endpoint removes the specified book from the database.

Response Content Type: `application/json`

#### Parameters

| Parameter | Value    | Parameter type | Data type |
| --------- | -------- | -------------- | --------- |
| id        | Required | Path           | Number    |

#### Response Messages

<table>

<tr>
<th>Parameter</th>
<th>Reason</th>
<th>Response</th>
</tr>

<tr>
<td>

**200**

</td>
<td>Successfully deleted book.</td>
<td>

```json
{
    "message": "Successfully deleted book."
}
```
</td>
</tr>

</table>

### DELETE: /author/{id}

#### Implementation notes

This endpoint removes the specified author from the database.

Response Content Type: `application/json`

#### Parameters

| Parameter | Value    | Parameter type | Data type |
| --------- | -------- | -------------- | --------- |
| id        | Required | Path           | Number    |

#### Response Messages

<table>

<tr>
<th>Parameter</th>
<th>Reason</th>
<th>Response</th>
</tr>

<tr>
<td>

**200**

</td>
<td>Author deleted successfully.</td>
<td>

```json
{
    "message": "Author deleted successfully."
}
```
</td>
</tr>

</table>
