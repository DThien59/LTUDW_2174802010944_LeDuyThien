<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Giỏ Hàng</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="css/menu.css">
  <style>
    img { border-radius: 8px; }
    .qty-input { width: 60px; text-align: center; }
  </style>
</head>
<body>
    <div class="header d-flex align-items-center justify-content-between">
        <a href="webbansach.php" class="logo-link">
            <div class="logo">Sachmoi.vn</div>
        </a>
        
        <div class="w-50">
            <input type="text" class="form-control" placeholder="Bạn cần tìm gì?">
        </div>
        <div>
            ☎ 077 575 9469 | <a href="giohang.php" style="text-decoration: none; color: black;">🛒 Giỏ hàng</a>
        </div>
    </div>
  <div class="container mt-5">
    <h3 class="mb-4">🛒 Giỏ Hàng Của Bạn</h3>
    <div id="cartContainer"></div>
    <div class="mt-3">
        <button onclick="history.back()" class="btn btn-secondary">← Tiếp tục mua sắm</button>
    </div>
  </div>

  <script>
    function renderCart() {
      const cart = JSON.parse(localStorage.getItem('cart')) || [];
      const container = document.getElementById('cartContainer');

      if (cart.length === 0) {
        container.innerHTML = "<p>Giỏ hàng đang trống.</p>";
        return;
      }

      let html = '<table class="table table-bordered align-middle text-center">';
      html += `
        <thead>
          <tr>
            <th>Ảnh</th>
            <th>Tên</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Thành tiền</th>
            <th>Xóa</th>
          </tr>
        </thead><tbody>
      `;

      cart.forEach((item, index) => {
        const thanhTien = item.price * item.quantity;
        html += `
          <tr>
            <td><img src="${item.image}" width="80"></td>
            <td>${item.name}</td>
            <td>${item.price.toLocaleString()}đ</td>
            <td>
              <input type="number" min="1" class="qty-input" value="${item.quantity}"
                     onchange="updateQuantity(${index}, this.value)">
            </td>
            <td>${thanhTien.toLocaleString()}đ</td>
            <td>
              <button class="btn btn-danger btn-sm" onclick="removeItem(${index})">Xóa</button>
            </td>
          </tr>
        `;
      });

      html += '</tbody></table>';
      container.innerHTML = html;
    }

    function updateQuantity(index, newQty) {
      const cart = JSON.parse(localStorage.getItem('cart')) || [];
      const qty = parseInt(newQty);
      if (qty > 0) {
        cart[index].quantity = qty;
        localStorage.setItem('cart', JSON.stringify(cart));
        renderCart();
      }
    }

    function removeItem(index) {
      const cart = JSON.parse(localStorage.getItem('cart')) || [];
      cart.splice(index, 1);
      localStorage.setItem('cart', JSON.stringify(cart));
      renderCart();
    }

    renderCart(); // Khởi động khi vào trang
  </script>
</body>
</html>



  