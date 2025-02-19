# 🏆 Website Quản lý Hội viên  
(Membership Management Website)  

## 📌 Tóm Tắt Dự Án  
Đây là một dự án mô phỏng phát triển website quản lý hội viên, với mục đích học hỏi và phát triển kỹ năng lập trình web và quản lý cơ sở dữ liệu. Sử dụng dữ liệu giả lập để mô phỏng chức năng của hệ thống.  

## 🚀 Tính Năng Chính  
- **Quản lý lưu trữ tài liệu**  
- **Quản lý khách hàng & đối tác**  
- **Quản lý câu lạc bộ**  
- **Quản lý hội phí, tài trợ, hạng thành viên**  
- **Quản lý hoạt động, thông báo, lịch họp**  

## 🛠 Công Nghệ Sử Dụng  
- **Ngôn Ngữ**: PHP  
- **Framework**: Laravel  
- **Cơ Sở Dữ Liệu**: MySQL  
- **Các Công Nghệ Khác**: HTML/CSS, Bootstrap, JavaScript, jQuery  

## 🔑 Tài Khoản Test  
```plaintext  
Tài Khoản: nguyenbin394@gmail.com  
Mật khẩu: password  
```  

## 📂 Cài Đặt & Chạy Dự Án  
### 1️⃣ Clone Repository  
```bash  
git clone https://github.com/Dat0801/quan-ly-hoi-vien.git
cd quan-ly-hoi-vien  
```
### 2️⃣ Cài Đặt Dependencies  
```bash  
composer install  
```
### 3️⃣ Cấu Hình `.env`  
Sao chép file `.env.example` và cập nhật thông tin database:  
```bash  
cp .env.example .env  
```
Chỉnh sửa `.env`:  
```env  
DB_DATABASE=ten_database  
DB_USERNAME=root  
DB_PASSWORD=your_password  
```
### 4️⃣ Tạo Key & Migrate Database  
```bash  
php artisan key:generate  
php artisan migrate --seed  
```
### 5️⃣ Chạy Server  
```bash  
php artisan serve  
```
API sẽ chạy tại `http://127.0.0.1:8000`.  

