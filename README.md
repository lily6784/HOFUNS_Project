# Installation Guide for HOFUNS_Project

## Overview

This guide provides step-by-step instructions for installing HOFUNS_Project.



### Online operation address: 

http://218.250.236.203/login.php



### Username and password:

**username:  admin1**

**password:  AdminTest**



## Prerequisites

- Ensure you have [Homebrew](https://brew.sh/) installed on your macOS.

## Installing PostgreSQL

1. **Install PostgreSQL using Homebrew:**

   ```bash
   brew install postgresql
   ```

2. **Start the PostgreSQL service:**

   ```bash
   brew services start postgresql
   ```

3. **Connect to PostgreSQL:**

   ```bash
   psql -U postgres
   ```

4. **CREATE ROLE root WITH LOGIN PASSWORD '12345678'**

   ```sql
   CREATE ROLE root WITH LOGIN PASSWORD '12345678';
   ```
5. **Set up the config.php file and connect to the database**
   
   <img width="414" alt="截屏2024-11-23 14 58 14" src="https://github.com/user-attachments/assets/7712375f-a2c2-47aa-aaa6-7b4be8dfb573">

7. **Then create a database and run the sql code according to the commands in the directory**

​		database files address:    **HOFUNS_Project - DataBase**

## Installing PHP

1. **Install PHP using Homebrew:**

   ```bash
   brew install php
   ```

2. **Start the PHP built-in server:**

   ```
    php -S localhost:8000
   ```

3. **Run PHP file:**
   ```
    php login.php
   ```
4. **Access your PHP file in a browser:**

   ```php
   http://localhost:8000/login.php
   ```

   php files address:  **HOFUNS_Project - htdocs_final_edition**

