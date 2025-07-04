# WeChatogether – PHP Chat App with Real-Time Messaging & Image Sharing 💬🖼️

**WeChatogether** is a real-time chat application built using core web technologies — PHP, MySQL, JavaScript, HTML, and CSS. It supports secure user authentication, image sharing, real-time message updates, and user profile customization. Designed and developed entirely by a 16-year-old aspiring software engineer.

🌐 Live site: [wechatogether.wuaze.com](https://wechatogether.wuaze.com)

---

## ✨ Features

- 🔐 **User Authentication**
  - Signup, login, logout
  - Secure password hashing
- 💬 **Real-Time Messaging**
  - Send and receive messages instantly (AJAX-based)
  - No page reloads required
- 🖼️ **Image Messaging**
  - Upload and send images in chat
  - File validation and preview support
- 👤 **User Profiles**
  - Upload/change profile pictures
  - Secure password change
- 🛡️ **Input Validation**
  - Frontend and backend form validation
  - Protects against empty fields and malicious inputs
- 🧩 **Modular File Structure**
  - Classes, API, includes, and UI separation
- 🌐 Hosted Live (via Wuaze)

---

## 🧱 Tech Stack

- **Frontend:** HTML5, CSS3, JavaScript (Vanilla)
- **Backend:** PHP (Object-Oriented)
- **Database:** MySQL
- **Server:** XAMPP / Apache
- **Hosting:** Wuaze.com

---

## 📂 Project Structure

chatApp-main/
├── api/ # Backend message/image endpoints
├── classes/ # PHP classes (User, Chat, DB, etc.)
├── includes/ # DB config, functions, sessions
├── images/ # Uploaded images (profile/chat)
├── ui/ # Frontend pages (chat, login, settings)
├── js/ # Real-time JS logic (refresh, send)
├── styles/ # CSS styling
├── database.sql # SQL schema
└── index.php # App entry point


## 🚀 Getting Started

### 🔧 Local Setup (via XAMPP or WAMP)

1. **Clone this repo:**
   ```bash
   git clone https://github.com/SabareesanThirukumaran/chatApp-main.git
   cd chatApp-main
2. Start Apache & MySQL (e.g., through XAMPP Control Panel)

3. Create a database via phpMyAdmin
4. Name it wechat_db, then import database.sql (coming soon)

Update DB config:
Edit /includes/config.php with your local DB username.

Place in server root:
Put the project in your web root (htdocs/), then navigate to:
http://localhost/chatApp-main

## 🤝 Contributing
Pull requests welcome!
To contribute:

1. Fork the project
2. Create your feature branch (git checkout -b feature/new-feature)
3. Commit changes (git commit -m 'Add new feature')
4. Push to your branch (git push origin feature/new-feature)
5. Open a Pull Request

## 🧑‍💻 Author
Sabareesan Thirukumaran
16-year-old aspiring software engineer
📧 thirukumaransabareesan18@gmail.com
🔗 GitHub Profile

## 📄 License
MIT License. Feel free to use and modify for learning or building your own projects.

## Demo

https://github.com/user-attachments/assets/aa654ea8-4b06-4e91-9592-ae957c850531

**Day 1**

Began creating the PHP file alongsid adding the necessary ui assets to be used later. Then created the design using html and css code and made sure to download Xampp in order to host the server on my client side.
![image](https://github.com/user-attachments/assets/7619e1c2-48cf-4885-baf4-63c627ec735b)

**Day 2**

Created the PHP files to manage the database, created the database on "phpmyadmin" and began working on how to send and store the data to the database.
![image](https://github.com/user-attachments/assets/481d4b68-3ff6-4900-9d76-ea0b717c3656)

**Day 3**

Made the login process. First pushed all the data from signup page onto the database, then retrieved (and read) the data, parsed into json and validated to allow logins.

![image](https://github.com/user-attachments/assets/b7da6d36-3704-4117-b9c0-d582d2fc4159)

**Day 4**

Debugged the login, logout, and signup pages. Then added the changes between the "chat", "contacts" and "settings" pages, and retrieved all users from the database and put them into "contacts"

![image](https://github.com/user-attachments/assets/5d17e1dd-325c-4859-8eee-4ebd45893aee)

**Day 5**

Added the settings page, allowed changes into the database from the settings page, kept getting bugs on the image changes but resolved the issue by decomposing the problem

![image](https://github.com/user-attachments/assets/17eb4404-1a2e-4140-960a-4075316859f3)

**Day 6**

Had some trouble getting the current user password and setting a new user password in the dayabase as well as the drag & drop image feature but resolved everything. Added - Image change, Drag & Drop image change, Current password Checker (settings page), Debugged settings page

![image](https://github.com/user-attachments/assets/61369747-bbe5-40d5-b700-6e95617b4059)

**Day 7**
MySQL had crashed, needed to install xampp again and clone this repo and debug the problem. Took some time but got it to run then started the message sending functionality after adding template messages

![image](https://github.com/user-attachments/assets/2efab3e8-c504-414e-bdd9-544360276ce8)

**Day 8**
Made alot of progress in the funcitonality of the chat system, fully completed it other than the image sending functionality. Only have minor problems left to finish.

![image](https://github.com/user-attachments/assets/02ae3be5-766c-4f7f-a59a-642a8f39191d)

**Day 9**
Completed the entire website, hosted on wechatogether.wuaze.com. Finished friend requests, accepts and contacts.

![image](https://github.com/user-attachments/assets/41c729d4-d57d-42c9-8df6-8e197aff2197)

