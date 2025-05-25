Charity Management sytem
A web-based platform designed to connect donors with individuals in need — particularly useful for local and small-scale charities.

This system has two user roles: User and Admin.

Features
👤 User Functionalities:
Users can register with their personal details like name, email, password, phone number, and address.

After registration, users can log in using their credentials.

On the User Dashboard, the following options are available:

Enter Donation – Record new donations.

View Donation Information – See details of past donations.

Request as Beneficiary – Submit a request for financial help.

Edit Profile – Update personal information.

🛠️ Admin Functionalities:
Admin logs in using an email and password.

On the Admin Dashboard, the following options are available:

View Donations – See all donation entries.

Approve/Reject Beneficiary Requests – Process user requests for help.

View Beneficiary List – See the list of all beneficiaries.

Update User Details – Modify user profiles as needed.

View Approved Requests – Track successfully processed requests.

✅ When a beneficiary request is approved, the user receives a notification.

🚀 How to Run the Website on Your Local Machine
Step 1:
Clone the repository into your project folder.

##bash
git clone <your-repository-link>

Step 2:
Install XAMPP if not already installed.

Step 3:
Start Apache and MySQL services in the XAMPP control panel.

Step 4:
Open phpMyAdmin (http://localhost/phpmyadmin), create a new database named:

##bash
charitysystem
Then import the provided .sql file into this database.

Step 5:
Open your browser and run:

##bash
http://localhost/your-folder-name/index.php

Replace your-folder-name with the folder where the project is saved inside the htdocs directory.


