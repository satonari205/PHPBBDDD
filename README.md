## Reference

Repository
https://github.com/BaseMax/PHPTaskDDD
https://github.com/BaseMax/ForumPlatformDDD

Books
https://amzn.asia/d/0alE4jpd

articles
https://zenn.dev/yamachan0625/books/ddd-hands-on


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

- GET api/threads/{thread_id}/comments
- GET api/comments/{id}
- POST api/comments
- PATCH api/comments/{id}
- DELETE api/comments/{id}


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
