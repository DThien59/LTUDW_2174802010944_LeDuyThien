<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>SACHMOI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/menu.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function searchBooks() {
            const keyword = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#book-table tbody tr');

            rows.forEach(row => {
                const title = row.cells[1].textContent.toLowerCase();
                const author = row.cells[2].textContent.toLowerCase();
                if (title.includes(keyword) || author.includes(keyword)) {
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
        <!-- Tìm kiếm sách -->
        <input id="searchInput" type="text" class="form-control" placeholder="Nhập tên sách hoặc tác giả..." oninput="searchBooks()">
    </div>
    <div>
        <div id="userArea">
          <a href="login.php" class="btn btn-outline-primary">Đăng nhập</a>
        </div>
    </div>
</div>

<div style="padding-top: 20px;">
    <div class="d-flex justify-content-between align-items-center my-3">
        <h2 class="mb-0">📘 Thêm sách mới</h2>
        <a href="category.php" class="btn btn-warning">🔧 Quản lý thể loại</a>
    </div>
    
    
        <form id="bookForm" class="mb-4">
            <div class="row mb-2">
                <div class="col-md-3">
                    <input type="text" id="title" class="form-control" placeholder="Tên sách" required>
                </div>
                <div class="col-md-2">
                    <input type="text" id="author" class="form-control" placeholder="Tác giả" required>
                </div>
                <div class="col-md-2">
                    <input type="number" id="price" class="form-control" placeholder="Giá" required>
                </div>
                <div class="col-md-2">
                    <input type="text" id="image_url" class="form-control" placeholder="URL ảnh bìa (nếu có)">
                </div>
                <div class="col-md-2">
                    <select id="category" class="form-control" required>
                        <option value="">-- Thể loại --</option>
                    </select>
                </div>                

                <div class="col-md-1">
                    <button type="submit" class="btn btn-primary w-100">Lưu</button>
                </div>
            </div>
        </form>



    <h2>📚 Danh sách sách</h2>
    <table class="table table-bordered" id="book-table">
        <thead class="table-secondary">
            <tr>
                <th>ID</th>
                <th>Tên sách</th>
                <th>Tác giả</th>
                <th>Giá</th>
                <th>Ảnh bìa</th>
                <th>Thể loại</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <!-- Dữ liệu sẽ được thêm ở đây -->
        </tbody>
    </table>
    <nav>
        <ul class="pagination justify-content-center" id="pagination"></ul>
    </nav>
    
</div>

</body>
<script>
    const form = document.getElementById('bookForm');
    let allBooks = [];
    const booksPerPage = 3;
    let currentPage = 1;


    function renderTablePage(page) {
        const tbody = document.querySelector("#book-table tbody");
        tbody.innerHTML = '';
        const start = (page - 1) * booksPerPage;
        const end = start + booksPerPage;
        const pageBooks = allBooks.slice(start, end);

        if (pageBooks.length === 0) {
            tbody.innerHTML = "<tr><td colspan='5'>Không có dữ liệu</td></tr>";
            return;
        }

        pageBooks.forEach(book => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${book.id}</td>
                <td>${book.title}</td>
                <td>${book.author}</td>
                <td>${Number(book.price).toLocaleString('vi-VN')} đ</td>
                <td>${book.image_url ? `<img src="${book.image_url}" width="60">` : "Không có ảnh"}</td>
                <td>${book.category}</td>
            `;
            tbody.appendChild(row);
        });
    }

    function renderPagination() {
        const pageCount = Math.ceil(allBooks.length / booksPerPage);
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

    function loadBooks() {
        fetch('get_books.php')
            .then(response => response.json())
            .then(data => {
                allBooks = data;
                currentPage = 1;
                renderTablePage(currentPage);
                renderPagination();
            })
            .catch(error => console.error("Lỗi khi tải dữ liệu:", error));
    }

    // Gọi khi tải trang
    window.onload = function () {
        checkLoginStatus();
        loadBooks();
    };
</script>


<script>
    let editMode = false;
    let editBookId = null;

    // Cập nhật lại hàm renderTablePage để thêm 2 nút
    function renderTablePage(page) {
        const tbody = document.querySelector("#book-table tbody");
        tbody.innerHTML = '';
        const start = (page - 1) * booksPerPage;
        const end = start + booksPerPage;
        const pageBooks = allBooks.slice(start, end);

        if (pageBooks.length === 0) {
            tbody.innerHTML = "<tr><td colspan='6'>Không có dữ liệu</td></tr>";
            return;
        }

        pageBooks.forEach(book => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${book.id}</td>
                <td>${book.title}</td>
                <td>${book.author}</td>
                <td>${Number(book.price).toLocaleString('vi-VN')} đ</td>
                <td>${book.image_url ? `<img src="${book.image_url}" width="60">` : "Không có ảnh"}</td>
                <td>${book.category}</td>
                <td>
                    <button class="btn btn-sm btn-warning me-1" onclick='editBook(${JSON.stringify(book)})'>Sửa</button>
                    <button class="btn btn-sm btn-danger" onclick='deleteBook(${book.id})'>Xóa</button>
                </td>
            `;
            tbody.appendChild(row);
        });
    }

    // Sự kiện submit form: xử lý thêm mới hoặc cập nhật
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        const bookData = {
            title: document.getElementById('title').value,
            author: document.getElementById('author').value,
            price: document.getElementById('price').value,
            image_url: document.getElementById('image_url').value,
            category: document.getElementById('category').value

        };

        if (editMode) {
            // Gửi yêu cầu cập nhật
            fetch('update_book.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id: editBookId, ...bookData })
            })
            .then(res => res.json())
            .then(result => {
                if (result.success) {
                    form.reset();
                    editMode = false;
                    editBookId = null;
                    loadBooks();
                } else {
                    alert("Lỗi khi cập nhật sách.");
                }
            });
        } else {
            // Gửi yêu cầu thêm mới
            fetch('add_book.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify(bookData)
            })
            .then(res => res.json())
            .then(result => {
                if (result.success) {
                    form.reset();
                    loadBooks();
                } else {
                    alert("Lỗi khi thêm sách.");
                }
            });
        }
    });

    // Hàm gọi khi nhấn nút sửa
    function editBook(book) {
        document.getElementById('title').value = book.title;
        document.getElementById('author').value = book.author;
        document.getElementById('price').value = book.price;
        document.getElementById('image_url').value = book.image_url;
        document.getElementById('category').value = book.category;
        editMode = true;
        editBookId = book.id;
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }

    // Hàm xóa sách
    function deleteBook(id) {
        if (!confirm("Bạn có chắc chắn muốn xóa sách này?")) return;

        fetch('delete_book.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ id: id })
        })
        .then(res => res.json())
        .then(result => {
            if (result.success) {
                loadBooks();
            } else {
                alert("Lỗi khi xóa sách.");
            }
        });
    }

</script>

<script>
    function loadCategories() {
        fetch('get_category.php')
            .then(res => res.json())
            .then(data => {
                const select = document.getElementById('category');
                select.innerHTML = '<option value="">-- Thể loại --</option>'; // reset
                data.forEach(cat => {
                    const option = document.createElement('option');
                    option.value = cat.id;
                    option.textContent = cat.name;
                    select.appendChild(option);
                });
            })
            .catch(error => console.error('Lỗi khi tải thể loại:', error));
    }

    window.onload = function () {
        checkLoginStatus();
        loadBooks();
        loadCategories();
    };
</script>

</html>
