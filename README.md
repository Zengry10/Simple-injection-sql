# 🕵🏻‍♂ Injection NOSQL 🕵🏻‍♂

### Hi 👋, I'm going to present you in this repository an example of **NoSQL Injection** rather basic in PHP Native.

I used MangoDB for the database by using **Atlas** which is an online database hosted with the Cloud (don't worry there is a free version which does the job very well). 

- https://www.mongodb.com/atlas/database

## How to run this project locally to try and play with it ?

If you use Atlas like me, you will have to change the **database connection information** and the **name of your database** if you decide to call it by another name than `user`.

To execute the project, you only have to git clone this project and launch the following command in your terminal: 

```php
  php -S localhost:8000 -t src
```

- #### Composer is obviously also necessary in the use of this project.

## But how does it work ?

Once the project is launched, you arrive in front of a rather basic connection form with two fields `("email", "password")`. The purpose of this flaw is to be able to connect only **when the password entered by the user is different from a password already present in the database**.

The `$ne` variable is a **MongoDB query operator** that stands for **"not equal"**, used to __filter out results that do not match the specified value__. In the original code, this operator is used in the query to check if the password provided in the form is not equal to the password stored in the database.
You can try by yourself to write a random password and you will see that the connection will be well established. On the contrary, if you type a password that exists in the database you will not be able to log in.


- That's why it's important to use prepared statements or other methods to properly escape user input when building queries to avoid injection into MongoDB.

## How to exploit and test this flaw with a software like Postman ?

**1.** Open Postman and create a new POST request

**2.** In the "URL" field, enter the URL of the endpoint that the login form submits to.

**3.** In the "Body" tab, select "x-www-form-urlencoded"

**4.** In the key field, enter "email" and in the value field enter a valid email address.

**5.** In the key field, enter "password" and in the value field, enter a MongoDB query operator such as { "$ne": "" } that would always return an empty result set, allowing the attacker to login without providing the correct password.

**6.** Send the request

## How to solve this flaw?

So to be more secure in your code, you should hash the password before storing it in the database and then compare the hashed version of the password provided in the form with the hashed version of the password stored in the database.
- You can also use a library such as `"bcrypt"` to hash the passwords in a secure way.

I put below a much more secure authentication version:

```bash
<?php
    $passwordFromForm = $_POST['password'];
    $hashedPasswordFromDB = "..."; // retrieve the hashed password from the DB

    if (password_verify($passwordFromForm, $hashedPasswordFromDB)) {
        // password is correct
    } else {
        // password is incorrect
    }
?>
```


#### I hope this **read me** could bring you the necessary information.
thanks for reading 😁
