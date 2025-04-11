<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/menu.css">

    <script>
        function handleLogin() {
          const username = document.getElementById('username').value.trim();
          const password = document.getElementById('password').value.trim();
          const role = document.getElementById('role').value;
          const message = document.getElementById('loginMessage');
        
          // Tài khoản mẫu để demo
          const users = [
            { username: 'user', password: '123', role: 'user' },
            { username: 'admin', password: '123', role: 'admin' }
          ];
        
          const foundUser = users.find(u => u.username === username && u.password === password && u.role === role);
        
          if (foundUser) {
            message.textContent = '';
            localStorage.setItem('currentUser', JSON.stringify(foundUser));
            // Chuyển hướng sau khi đăng nhập thành công (giả lập)
            if (role === 'admin') {
              window.location.href = 'admin.php';
            } else {
              window.location.href = 'webbansach.php';
            }
          } else {
            message.textContent = 'Sai tài khoản, mật khẩu hoặc vai trò.';
          }
        
          return false; // Ngăn submit form mặc định
        }
        </script>
        

</head>
<body>
  <div class="header d-flex align-items-center justify-content-between">
      <a href="webbansach.php" class="logo-link">
          <div class="logo">Sachmoi.vn</div>
      </a>
  </div>

  <!-- Thêm khối bọc để căn giữa -->
  <div class="d-flex justify-content-center align-items-start" style="min-height: 100vh; padding-top: 80px;">
    <div class="card p-4 shadow" style="max-width: 400px; width: 100%; background: #8f9d9d;">
      <h3 class="text-center mb-4">Đăng Nhập</h3>
      <form id="loginForm" onsubmit="return handleLogin()">
        <div class="mb-3">
          <label for="username" class="form-label">Tài khoản</label>
          <input type="text" class="form-control" id="username" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Mật khẩu</label>
          <input type="password" class="form-control" id="password" required>
        </div>
        <div class="mb-3">
          <label for="role" class="form-label">Vai trò</label>
          <select id="role" class="form-select">
            <option value="user">User</option>
            <option value="admin">Admin</option>
          </select>
        </div>
        <button type="submit" class="btn w-100" style="background-color: #66CCCC; margin-top: 10px;">Đăng nhập</button>
      </form>
      <div id="loginMessage" class="mt-3 text-danger text-center"></div>
    </div>
  </div>
</body>

</html>