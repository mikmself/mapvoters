
# MAP VOTERS API

Map Voters Rest API


## Authors

- [@mikmself](https://www.github.com/mikmself)
- [@charezt23](https://www.github.com/charezt23)
- [@Idasut17](https://www.github.com/Idasut17)
- [@Ellazian](https://www.github.com/Ellazian)
- [@DinaSinurat05](https://www.github.com/DinaSinurat05)

## Installation

Install mapvoters with composer

```bash
  git clonehttps://github.com/mikmself/mapvoters.git
  cd mapvoters
  composer install || composer update
```
rename .env.exampe to .env  
setup database
```bash
php artisan migrate
php artisan db:seed
php artisan serve
```
To see hidden route list
```bash
php artisan route:list
```


## API Reference

#### Get all items

```http
  GET /api/items
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `api_key` | `string` | **Required**. Your API key |

#### Get item

```http
  GET /api/items/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| 'api_key' | 'string' | **Required**. Your API key        |
| `id`       | `string` | **Required**. Id of item to fetch|

#### Create item

```http
  POST /api/items
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Your API key |

#### Update item

```http
  PUT /api/items/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Your API key |
| `id`       | `string` | **Required**. Id of item to fetch|

#### Delete item

```http
  DELETE /api/items/${id}
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `api_key`      | `string` | **Required**. Your API key |





## License

[MIT](https://choosealicense.com/licenses/mit/)


## Tech Stack

**Client:** Livewire, Filament Component

**Server:** Laravel

