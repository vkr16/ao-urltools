<p align="center">
<img src="https://github.com/vkr16/akuonline-2022/blob/main/public/assets/img/logo.png?raw=true" alt"Inventoman logo" width="20%"></img>
<div align="center">
<img src="https://img.shields.io/badge/App Version-1.1-orange"></img> &nbsp; 
<img src="https://img.shields.io/badge/PHP%20Version-8.1.10-blue"></img> &nbsp;
<img src="https://img.shields.io/badge/CodeIgniter-4.3.1-red"></img> &nbsp;
<img src="https://img.shields.io/badge/Bootstrap-5.2.3-blueviolet"></img> &nbsp;
<img src="https://img.shields.io/badge/JQuery-3.6.1-blue"></img> &nbsp;
</div>
</p>

---
# Personal Project : AkuOnline Tools

Welcome to my personal project repository! This is a work of mine that I've done on the AO Tools (AkuOnline Tools) project.

# Project Overview

AkuOnline is the name of my website which includes various information about me and my portfolio as well as some free online tools that I provide for anyone to use such as url shorteners, qr code generators and many other tools will be coming soon. This repository contains the online tools that I provide on AkuOnline website.

You can create your own account for free to use the tools.

You can visit it here : [AkuOnline Tools](https://fma.my.id)

You can also clone this repository and host your own url shortener and the other tools with your own domain, and **It's Free**.

# Technologies

- PHP 8.1
- CodeIgniter 4
- HTML
- CSS
- JavaScript
- Bootstrap 5.2.2
- Some other JavaScript library

# Why I'm Sharing These Projects

I'm sharing these projects as part of my portfolio to showcase my skills and experience as a web developer. I hope that they demonstrate my ability to work with different technologies and my commitment to delivering high-quality work.

# How to Use This Project

This project is meant to showcase my skills and experience as a web developer. You are welcome to explore the project and use it as inspiration for your own work.

**<p style="color:#ff4444">However, please note that this project was done for a specific client and may not be suitable for your own needs. Please do not use any of the code or assets without permission especially for commercial use.</p>**

## Installation Guide

1. [Download the portfolio release here](https://github.com/vkr16/ao-urltools/releases/tag/v1.1-portfolio)
2. Extract the zip and copy it to your localhost or server directory
 - Copy the files inside `main_host` folder to your subdomain folder 

 - Copy the filesinside `forwarder_host` folder to your domain folder

    - for example I used 
      - `cp.fma.my.id` as my `main_host` / control panel 
      - `fma.my.id` as my `forwarder_host` 
    - so the login page will be on `cp.fma.my.id/login` and 
    - the shortened link will be like `fma.my.id/t2HsM2` 
3. Import `aotools.sql` to your database server
4. Configure these variable in .env file on each folder (`main_host` and `forwarder_host`)
   - `app.baseURL = [YOUR BASE URL HERE | example: https://fma.my.id/]`
   - `database.default.hostname = [YOUR DATABASE HOST | example: localhost]`
   - `database.default.database = [YOUR DATABASE NAME | example: aotools]`
   - `database.default.username = [YOUR DATABASE USERNAME | example: root]`
   - `database.default.password = [YOUR DATABASE PASSWORD | example: root]`
   - `MAIN_HOST = [YOUR MAIN_HOST BASE URL | example : https://cp.fma.my.id/]`
   - `FORWARDER_HOST = [YOUR FORWARDER_HOST BASE URL | example https://fma.my.id/]`
5. You can optionally change the `ENCRYPTION_KEY` and `ENCRYPTION_IV` value based on your preference but please make sure you change both `main_host's` and `forwared_host's` with the same value, or you can just leave it with default value.

## Basic Usage Guide

1. Run the application by accessing the control panel url 
2. The first page you will see is the login page, you can log in with your account or create a new one.
   - Pre-registered account :
     - `Email = admin@akuonline.my.id`
     - `Password = admin`
5. You can explore the rest of the features on this application by yourself


# Contact Me

If you have any questions about this project or would like to discuss a potential freelance opportunity, please feel free to contact me. My email address is fikri.droid16@gmail.com or visit my web page at [akuonline.my.id](https://akuonline.my.id).

Thank you for taking the time to review my project portfolio!


<hr>
<p align="center">&copy; 2022 Fikri Miftah Akmaludin </p>
