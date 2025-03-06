Laravel Developer Interview Task

Task 1: UI/UX - Web Design & Development
Create a simple blog page with the following requirements:
Use Bootstrap or Tailwind CSS for responsive design.
Display blog posts with a title, image, short description, and a "Read More" button.
Implement a dark mode toggle for better UI experience.
Ensure the design is mobile-friendly and follows good UX principles.


Task 2: Laravel Blade & Backend Development
Develop a basic User Management system with the following features:
Use Laravel Blade templates for front-end views.
Allow users to register, log in, and log out.
Implement role-based authentication (Admin & User).
Admin should be able to create, update, delete users from the dashboard.

Task 3: MySQL Database Knowledge
Create a database schema for an e-commerce system with the following tables:
Users (id, name, email, password, role)
Products (id, name, description, price, stock, created_at)
Orders (id, user_id, total_price, status, created_at)
Order_Items (id, order_id, product_id, quantity, price)
Write the necessary MySQL queries for:
Fetching all products with more than 10 stock.
Fetching all orders placed by a specific user.
Updating product stock after an order is placed.

Task 4: API Integration Knowledge
Integrate a third-party API in Laravel:
Use https://jsonplaceholder.typicode.com/users API to fetch user data.
Display the user list in a Blade view with name, email, and address.
Implement a search bar to filter users by name.
Handle API errors and display appropriate messages.

download the source code from github
paste the downloaded folder BlogApp into Xampp/htdocs/BlogApp , then

Database
Attached the SQL folder - inside the blog.sql file
import the sql file into MYSQL

after the setup

run this command: php artisan serve in your terminal 
show http://127.0.0.1:8000 show this link - ctrl+click

first view in login page - user
email id : bahat@gmail.com
password: bahat@123

Admin:
email id : vishnu@gmail.com
password:vishnu@123

User can login , page redirect to User dashboard like blog page,Comment function using AJax without page reloaded and API -search functionality Page
Admin can login, Page redirect to Admin dashboard , in dashboard have Create blog , manage blog like edit, delete also, And Admin can Manage User Account like create the user, edit,update and delete the user.

Thanking You,


