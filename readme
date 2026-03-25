1.สร้างไฟล์ index.php ไว้ที่ root

2.สร้างไฟล์ .htacess เพื่อ rewrite ให้ทำงานที่ index.php ที่เดียว
    RewriteEngine On

    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteRule ^ index.php [QSA,L]

3.สร้างไฟล์ composer.json เพื่อตั้งค่า autoload
    {
        "autoload": {
            "psr-4": {
            "App\\": "app/"
            }
        }
    }

4.สร้าง folder app เพื่อให้สอดคล้องกับที่ตั้งค่าใน autoload ประกอบด้วย
    ** trip ** การตั้งชื่อไฟล์ให้ใช้ตัวพิมพ์ใหญ่ให้สื่อความหมาย และตั้งชื่อ Class ให้ตรงกับชื่อไฟล์ เช่น ชื่อไฟล์ คือ HomeControler.php ชื่อคลาสจะเป็น HomeControler
  - Controllers เป็น controller สำหรับ models แต่ละส่วน เช่น HomeControler, UserController
  - Core ประกอบด้วยไฟล์ย่อยหลัก ๆ 5 ไฟล์
        1.Controller.php เป็น controller หลักในการเรียกใช้ controller ต่าง ๆ ไม่ว่าจะเป็นการเข้าถึง view หรือ หน้าเพจต่าง ๆ และเป็นการเข้าถึงข้อมูล json
        2.Database.php เป็น method สำหรับเชื่อมต่อฐานข้อมูล โดยตัวอย่างโครงสร้างนี้จะรองรับได้มากกว่า 1 ฐานข้อมูล
        3.helper.php เป็น function helper สำหรับช่วยในการเข้าถึง path assets ต่าง ๆ ในโปรเจ็ค
        4.MiddlewareInterface.php (เป็นทางเลือก)
        5.Router.php เป็น router หลัก ๆ ในการเข้าถึง endpoint ในโปรเจ็ค
        6.View.php เป็น view หลักในการเรียกใช้ style script และ page
  - Middleware (เป็นทางเลือก)
  - Models เป็น Service ต่าง ๆ ที่เรียกใช้ข้อมูลจากฐานข้อมูล
  - Views ประกอบด้วย layouts สำหรับจัดการ header footer menu ต่าง ๆ ที่ใช้หลาย ๆ page และตามด้วย page ของแต่ละส่วน เช่น
    layouts ->
        - main.php
    user ->
        - index.php

5.สร้าง folder router สำหรับเป็นตัวกลางรับ endpoint ต่าง ๆ
  router -> web.php

6.สร้าง folder config สำหรับตั้งค่าฐานข้อมูล (แนะนำให้ใช้ .env)
  config -> config.php

7.สร้าง folder assets สำหรับวางไฟล์ css, js และ img
