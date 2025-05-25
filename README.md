# 🎗️ Charity Management System

A **web-based platform** designed to connect donors with individuals in need — particularly useful for local and small-scale charities.

This system includes two user roles: **User** and **Admin**.

---

## 👤 User Functionalities

- Users can **register** with personal details like:
  - Name  
  - Email  
  - Password  
  - Phone Number  
  - Address  

- After registration, users can **log in** using their credentials.

### 🧭 User Dashboard Features:
- **Enter Donation** – Record new donations.  
- **View Donation Information** – See details of past donations.  
- **Request as Beneficiary** – Submit a request for financial help.  
- **Edit Profile** – Update personal information.  

---

## 🛠️ Admin Functionalities

- Admin logs in using **email** and **password**.

### 🧭 Admin Dashboard Features:
- **View Donations** – See all donation entries.  
- **Approve/Reject Beneficiary Requests** – Process user requests for help.  
- **View Beneficiary List** – See the list of all beneficiaries.  
- **Update User Details** – Modify user profiles as needed.  
- **View Approved Requests** – Track successfully processed requests.  

✅ When a **beneficiary request** is approved, the user receives a **notification**.

---

## 🚀 How to Run the Website on Your Local Machine

### Step 1: Clone the Repository
<pre> bash<br>
git clone your-repository-link
</pre>
### 📌 Step 2: Install XAMPP
Download and install XAMPP from:  
👉 [https://www.apachefriends.org](https://www.apachefriends.org)

### 📌 Step 3: Start Apache and MySQL Services
- Open the **XAMPP Control Panel**
- Start the following services:
  - ✅ Apache
  - ✅ MySQL
 
### 📌 Step 4: Setup the Database
1. Open **phpMyAdmin** in your browser:  
   http://localhost/phpmyadmin

2. Create a new database named:
   "charitysystem"
3. Import the provided `.sql` file into this database.

### 📌 Step 5: Run the Project
Open your browser and navigate to: <br>
http://localhost/your-folder-name/index.php

<br>
> 🔁 Replace `your-folder-name` with the actual name of your project folder placed inside the `htdocs` directory.

---

## ✅ Notes

- Ensure your project folder is placed in:  
  `C:/xampp/htdocs/`

- Use modern browsers like Chrome or Firefox for best performance.

---

