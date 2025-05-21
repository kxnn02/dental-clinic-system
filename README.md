# 🦷 Dental Clinic Appointment System

## ✨ About the Project
Hey there! Welcome to our **Dental Clinic Appointment System**, a project built by **Kenneth Fernandez, Andrei Baguisa, and Marvin Miranda** for our **final Web Development project** as **first-year BSIT students at SSCR - Manila**. 🎓  

The goal? **Simplify appointment booking** for students and dentists at **San Sebastian College Recoletos - Manila** while making it **efficient and user-friendly**.  

## 🚀 Features
✅ **Login System:** Authentication for students, dentists, and admins  
✅ **Book an Appointment:** Students can select available dates & dentists  
✅ **Upcoming Appointments Display:** Personalized schedules for each user  
✅ **Appointment Status Updates:** Dentists can approve, complete, or cancel bookings  
✅ **Role-Based Dashboards:** Different views for students, dentists, and admins  
✅ **Sleek UI:** Modern, clean design for easy navigation  

## 🛠️ Setup Guide

### **1️⃣ Install Requirements**
Make sure you have **PHP**, **MySQL**, and a **local server (XAMPP, WAMP, etc.)**.

### **2️⃣ Set Up the Database**
1. **Import `database.sql`** into **phpMyAdmin** (or your preferred database manager).  
2. **Update `config.php`** with your local settings:  

   ```php
   <?php
   $conn = mysqli_connect("localhost", "root", "", "dental_clinic_db");
   if (!$conn) {
       die("Connection failed: " . mysqli_connect_error());
   }
   ?>
