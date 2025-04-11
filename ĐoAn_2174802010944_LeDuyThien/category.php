<!-- category.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quản lý thể loại</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="css/menu.css">

  <script>
    function searchCategories() {
        const keyword = document.getElementById('searchInput').value.toLowerCase();
        const rows = document.querySelectorAll('#category-table tbody tr');

        rows.forEach(row => {
            const name = row.cells[1].textContent.toLowerCase();
            if (name.includes(keyword)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }
</script>

  <script>
    // Hàm kiểm tra trạng thái đăng nhập
    function checkLoginStatus() {
    const user = JSON.parse(localStorage.getItem('currentUser'));
    const userArea = document.getElementById('userArea');

    if (user) {
        // Nếu đã đăng nhập → Hiển thị tên và dropdown
        userArea.innerHTML = `
        <div class="dropdown">
            <button class="btn btn-outline-success dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Xin chào, ${user.username}
            </button>
            <ul class="dropdown-menu dropdown-menu-end">
            <li><a class="dropdown-item" href="#" onclick="logout()">Đăng xuất</a></li>
            </ul>
        </div>
        `;
    } else {
        // Nếu chưa đăng nhập → Hiện nút đăng nhập
        userArea.innerHTML = `<a href="login.php" class="btn btn-outline-primary">Đăng nhập</a>`;
    }
    }

    // Hàm đăng xuất
    function logout() {
    localStorage.removeItem('currentUser');
    window.location.href = 'login.php';
    }

    // Gọi hàm khi trang tải xong
    window.onload = checkLoginStatus;
</script>

</head>
<body>

<div class="header d-flex align-items-center justify-content-between">
  <a href="webbansach.php" class="logo-link">
    <div class="logo">Sachmoi.vn</div>
  </a>

  <div class="w-50">
    <input id="searchInput" type="text" class="form-control" placeholder="Nhập thể loại..." oninput="searchCategories()">
</div>

  <div id="userArea">
    <a href="login.php" class="btn btn-outline-primary">Đăng nhập</a>
  </div>
</div>

  <h2 style="padding-top: 20px;">📂 Quản lý thể loại</h2>

  <form id="categoryForm" class="d-flex mb-4">
    <input type="text" id="name" class="form-control me-2" placeholder="Tên thể loại" required>
    <button type="submit" class="btn btn-success">Lưu</button>
  </form>

  <!-- Danh sách thể loại -->
  <table class="table table-bordered" id="category-table">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Tên thể loại</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <!-- Dữ liệu sẽ được thêm bằng JS -->
        </tbody>
    </table>
    <nav>
        <ul class="pagination justify-content-center" id="pagination"></ul>
    </nav>
  <a href="admin.php" class="btn btn-secondary mt-3">⬅️ Quay về</a>



</body>

<script>
    const form = document.getElementById('categoryForm');
    let allCategories = [];
    const categoriesPerPage = 3;
    let currentPage = 1;
    let editMode = false;
    let editCategoryId = null;

    function renderTablePage(page) {
        const tbody = document.querySelector("#category-table tbody");
        tbody.innerHTML = '';
        const start = (page - 1) * categoriesPerPage;
        const end = start + categoriesPerPage;
        const pageCategories = allCategories.slice(start, end);

        if (pageCategories.length === 0) {
            tbody.innerHTML = "<tr><td colspan='3'>Không có dữ liệu</td></tr>";
            return;
        }

        pageCategories.forEach(category => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${category.id}</td>
                <td>${category.name}</td>
                <td>
                    <button class="btn btn-sm btn-warning me-1" onclick='editCategory(${JSON.stringify(category)})'>Sửa</button>
                    <button class="btn btn-sm btn-danger" onclick='deleteCategory(${category.id})'>Xóa</button>
                </td>
            `;
            tbody.appendChild(row);
        });
    }

    function renderPagination() {
        const pageCount = Math.ceil(allCategories.length / categoriesPerPage);
        const pagination = document.getElementById('pagination');
        pagination.innerHTML = '';

        for (let i = 1; i <= pageCount; i++) {
            const li = document.createElement('li');
            li.className = `page-item ${i === currentPage ? 'active' : ''}`;
            li.innerHTML = `<button class="page-link">${i}</button>`;
            li.addEventListener('click', () => {
                currentPage = i;
                renderTablePage(currentPage);
                renderPagination();
            });
            pagination.appendChild(li);
        }
    }

    function loadCategories() {
        fetch('get_category.php')
            .then(response => response.json())
            .then(data => {
                allCategories = data;
                currentPage = 1;
                renderTablePage(currentPage);
                renderPagination();
            })
            .catch(error => console.error("Lỗi khi tải dữ liệu:", error));
    }

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        const categoryData = {
            name: document.getElementById('name').value
        };

        if (editMode) {
            fetch('update_category.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id: editCategoryId, ...categoryData })
            })
            .then(res => res.json())
            .then(result => {
                if (result.success) {
                    form.reset();
                    editMode = false;
                    editCategoryId = null;
                    loadCategories();
                } else {
                    alert("Lỗi khi cập nhật danh mục.");
                }
            });
        } else {
            fetch('add_category.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(categoryData)
            })
            .then(res => res.json())
            .then(result => {
                if (result.success) {
                    form.reset();
                    loadCategories();
                } else {
                    alert("Lỗi khi thêm danh mục.");
                }
            });
        }
    });

    function editCategory(category) {
        document.getElementById('name').value = category.name;
        editMode = true;
        editCategoryId = category.id;
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    function deleteCategory(id) {
        if (!confirm("Bạn có chắc chắn muốn xóa danh mục này?")) return;

        fetch('delete_category.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: id })
        })
        .then(res => res.json())
        .then(result => {
            if (result.success) {
                loadCategories();
            } else {
                alert("Lỗi khi xóa danh mục.");
            }
        });
    }

    window.onload = function () {
        checkLoginStatus(); // Nếu không dùng login, có thể xóa dòng này
        loadCategories();
    };
</script>
</html>
