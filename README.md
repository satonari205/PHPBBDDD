This PHPBBDDD project is created by its author to learn about DDD.

## API Routes

### Authentication

- POST api/register
- POST api/login
- POST api/logout

### User

- GET api/user -> indentify with token
- GET api/users
- PUT api/user/{id}
- DELETE api/user/{id}

### Treads

- GET api/thread/{id}
- GET api/threads
- POST api/thread
- PATCH api/thread/{id}
- DELETE api/thread/{id}

### Comments

- GET api/threads/{thread_id}/comments/{id}
- GET api/threads/{thread_id}/comments
- POST api/threads/{thread_id}/comments
- PATCH api/threads/{thread_id}/comments/{id}
- DELETE api/threads/{thread_id}/comments/{id}

### Search

- GET api/search?q={query}


## DatabaseSchema

### Users

- `id`: int (primary key)
- `name`: varchar(255)
- `email`: varchar(255)
- `password`: varchar(255)
- `created_at`: timestamp
- `updated_at`: timestamp

### Threads

- `id`: int (primary key)
- `user_id`: int (foreign key to Users table)
- `title`: varchar(255)
- `body`: text
- `created_at`: timestamp
- `updated_at`: timestamp

### Comments

- `id`: int (primary key)
- `user_id`: int (foreign key to Users table)
- `thread_id`: int (foreign key to Threads table)
- `body`: text
- `upvotes`: int
- `created_at`: timestamp
- `updated_at`: timestamp
