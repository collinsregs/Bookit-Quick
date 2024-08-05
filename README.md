# BookItQuick.com

## Database Setup

This project uses SQLite 3 for the database. The SQL dump file 'dump.sql' can be found in the root directory of this project.


## Database Setup

This project uses SQLite 3 for the database. The SQL dump file 'dump.sql' can be found in the root directory of this project.

To set up the database, you will need to run the migrations and seed the database. This can be done with the following command:

```bash
php artisan migrate --seed
```


## Administrator Login

After migrating and seeding the database, you can log in as an administrator using the following credentials:
```
- Name: Test User
- Email: cit2230412020@mmu.ac.ke
- Password: testuserpassword
```

## Email Services

Email services are set up with Postmark. However, due to the account awaiting approval, emails can only be sent within the same domain (@mmu.ac.ke) and are capped at 100 emails monthly.

## Thank You

Finally, thank you for the opportunity to present this project. If you have any questions or need further information, please feel free to reach out.
]
