<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang Sách Kinh Dị</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/menu.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Thông báo thành công -->
    <div id="alertBox" class="alert alert-success position-fixed top-0 end-0 m-3 d-none" role="alert" style="z-index: 1055;">
        ✅ Sản phẩm đã được thêm vào giỏ hàng!
        </div>
    
        <script>
          function addToCart(name, price, image) {
            const cart = JSON.parse(localStorage.getItem('cart')) || [];
        
            // Kiểm tra nếu đã có sản phẩm trong giỏ thì tăng số lượng
            const index = cart.findIndex(item => item.name === name);
            if (index !== -1) {
              cart[index].quantity += 1;
            } else {
              cart.push({ name, price, image, quantity: 1 });
            }
        
            localStorage.setItem('cart', JSON.stringify(cart));
        
            // Hiển thị thông báo
            const alertBox = document.getElementById('alertBox');
            alertBox.classList.remove('d-none');
            setTimeout(() => {
              alertBox.classList.add('d-none');
            }, 2000);
        
            // Đóng modal nếu có
            const modalEl = document.getElementById('productModal');
            if (modalEl) {
              const modal = bootstrap.Modal.getInstance(modalEl);
              modal.hide();
            }
          }
        </script>

        <script>
            function searchBooks() {
                const keyword = document.getElementById('searchInput').value.toLowerCase();
                const productCards = document.querySelectorAll('.product-card');
                
                productCards.forEach(card => {
                    const title = card.querySelector('.product-title').textContent.toLowerCase();
                    const author = card.querySelector('.product-author').textContent.toLowerCase();
                
                    if (title.includes(keyword) || author.includes(keyword)) {
                    card.parentElement.style.display = 'block'; // Hiển thị lại thẻ cha col-md-3
                    } else {
                    card.parentElement.style.display = 'none';
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
        <input id="searchInput" type="text" class="form-control" placeholder="Bạn cần tìm gì?" oninput="searchBooks()">
    </div>
    <div>
        ☎ 077 575 9469 | <a href="giohang.php" style="text-decoration: none; color: black;">🛒 Giỏ hàng</a>
        <div id="userArea">
          <a href="login.php" class="btn btn-outline-primary">Đăng nhập</a>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="container d-flex" style="background: #f6ba9c;">
            <div class="col-2 nav-categories" style=" margin-left: -12px;">
                <a href="truyentranh.php" id="truyentranh" >📖 Truyện Tranh</a>
                <a href="langman.php" id="langman">📖 Lãng Mạn</a>
                <a href="trinhtham.php" id="trinhtham">📖 Trinh Thám</a>
                <a href="kinhdi.php" id="kinhdi" style="background-color: rgb(246, 225, 225);">📖 Kinh Dị</a>
                <a href="cotich.php" id="cotich">📖 Cổ Tích</a>
                <a href="giaoduc.php" id="giaoduc">📖 Giáo Dục</a>
            </div>
        
            <!-- Carousel bên phải -->
            <div class="col-md-9" style="margin-left: 100px;">
                <div id="bannerCarousel" class="carousel slide mb-5" data-bs-ride="carousel" data-bs-interval="3000">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                        <img src="images/TooScaredToSleep.jpg" class="d-block w-100" alt="Banner 1">
                        </div>
                        <div class="carousel-item">
                        <img src="images/TheBuried.jpg" class="d-block w-100" alt="Banner 2">
                        </div>
                        <div class="carousel-item">
                        <img src="images/THESILENCEOFTHELAMBS.jpg" class="d-block w-100" alt="Banner 3">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon"></span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon"></span>
                    </button>
                </div>
            </div>
        </div>
        

      <div class="text-center mb-3">
        <h5 class="fw-bold">KINH DỊ</h5>
      </div>

      <div class="row text-center mb-5">
        <div class="col-md-3 mb-4">
          <div class="product-card d-flex flex-column justify-content-between">
            <img src="images/TooScaredToSleep.jpg" class="img-fluid mb-2 product-img">
            <p class="fw-bold text-danger">150,000đ</p>
            <p class="product-title">TOO SCARED TO SLEEP</p>
            <p class="product-author">Andrew Duplessie</p>
            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#TooScaredToSleep">MUA NGAY</button>

          </div>        
        </div>
      
        <div class="col-md-3 mb-4">
          <div class="product-card d-flex flex-column justify-content-between">
            <img src="images/TheBuried.jpg" class="img-fluid mb-2 product-img">
            <p class="fw-bold text-danger">150,000đ</p>
            <p class="product-title">THE BURIED</p>
            <p class="product-author">Melissa Grey</p>
            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#TheBuried">MUA NGAY</button>
          </div>
        </div>
      
        <div class="col-md-3 mb-4">
          <div class="product-card d-flex flex-column justify-content-between">
            <img src="images/TAKEYOURTURNTEDDY.jpg" class="img-fluid mb-2 product-img">
            <p class="fw-bold text-danger">150,000đ</p>
            <p class="product-title">TAKE YOUR TURN TEDDY</p>
            <p class="product-author">Haley Newlin</p>
            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#TakeYourTurnTeddy">MUA NGAY</button>
          </div>
        </div>
      
        <div class="col-md-3 mb-4">
          <div class="product-card d-flex flex-column justify-content-between">
            <img src="images/THESILENCEOFTHELAMBS.jpg" class="img-fluid mb-2 product-img">
            <p class="fw-bold text-danger">150,000đ</p>
            <p class="product-title">THE SILENCE OF THE LAMBS</p>
            <p class="product-author">Thomas Harris</p>
            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#THESILENCEOFTHELAMBS">MUA NGAY</button>
          </div>
        </div>
      </div>

      <div class="row text-center mb-5">
        <div class="col-md-3 mb-4">
          <div class="product-card d-flex flex-column justify-content-between">
            <img src="images/TooScaredToSleep.jpg" class="img-fluid mb-2 product-img">
            <p class="fw-bold text-danger">150,000đ</p>
            <p class="product-title">TOO SCARED TO SLEEP</p>
            <p class="product-author">Andrew Duplessie</p>
            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#TooScaredToSleep">MUA NGAY</button>
          </div>        
        </div>
      
        <div class="col-md-3 mb-4">
          <div class="product-card d-flex flex-column justify-content-between">
            <img src="images/TheBuried.jpg" class="img-fluid mb-2 product-img">
            <p class="fw-bold text-danger">150,000đ</p>
            <p class="product-title">THE BURIED</p>
            <p class="product-author">Melissa Grey</p>
            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#TheBuried">MUA NGAY</button>
          </div>
        </div>
      
        <div class="col-md-3 mb-4">
          <div class="product-card d-flex flex-column justify-content-between">
            <img src="images/TAKEYOURTURNTEDDY.jpg" class="img-fluid mb-2 product-img">
            <p class="fw-bold text-danger">150,000đ</p>
            <p class="product-title">TAKE YOUR TURN TEDDY</p>
            <p class="product-author">Haley Newlin</p>
            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#TakeYourTurnTeddy">MUA NGAY</button>
          </div>
        </div>
      
        <div class="col-md-3 mb-4">
          <div class="product-card d-flex flex-column justify-content-between">
            <img src="images/THESILENCEOFTHELAMBS.jpg" class="img-fluid mb-2 product-img">
            <p class="fw-bold text-danger">150,000đ</p>
            <p class="product-title">THE SILENCE OF THE LAMBS</p>
            <p class="product-author">Thomas Harris</p>
            <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#THESILENCEOFTHELAMBS">MUA NGAY</button>
          </div>
        </div>
      </div>

    </div>
</div>
</body>

<footer class="footer pt-4">
    <div class="container">
      <div class="row text-start">
        <div class="col-md-3">
          <h6 class="fw-bold">HỖ TRỢ KHÁCH HÀNG</h6>
          <p>Sản phẩm & Đơn hàng: 0775 759 469</p>
          <p>Kỹ thuật & Bảo hành: 0775 759 469</p>
          <p>Điện thoại: (077) 575 9469 (giờ hành chính)</p>
          <p>Email: thien.2174802010944@vanlanguni.vn</p>
          <p>Địa chỉ: 69/68 Đặng Thùy Trâm, P. 13, Q. Bình Thạnh, Tp. HCM</p>
        </div>
        <div class="col-md-3">
          <h6 class="fw-bold">TRỢ GIÚP</h6>
          <ul class="list-unstyled">
            <li><a href="#">Hướng dẫn mua hàng</a></li>
            <li><a href="#">Phương thức thanh toán</a></li>
            <li><a href="#">Phương thức vận chuyển</a></li>
            <li><a href="#">Chính sách đổi - trả</a></li>
            <li><a href="#">Chính sách bồi hoàn</a></li>
            <li><a href="#">Câu hỏi thường gặp (FAQs)</a></li>
          </ul>
        </div>
        <div class="col-md-3">
          <h6 class="fw-bold">TÀI KHOẢN CỦA BẠN</h6>
          <ul class="list-unstyled">
            <li><a href="#">Cập nhật tài khoản</a></li>
            <li><a href="giohang.php">Giỏ hàng</a></li>
            <li><a href="#">Lịch sử giao dịch</a></li>
            <li><a href="#">Sản phẩm yêu thích</a></li>
            <li><a href="#">Kiểm tra đơn hàng</a></li>
          </ul>
        </div>
        <div class="col-md-3">
          <h6 class="fw-bold">SACHMOI</h6>
          <ul class="list-unstyled">
            <li><a href="#">Giới thiệu sachmoi.vn</a></li>
            <li><a href="#">SACHMOI trên Facebook</a></li>
            <li><a href="#">Liên hệ SACHMOI</a></li>
            <li><a href="#">Đặt hàng theo yêu cầu</a></li>
          </ul>
        </div>
      </div>
  
      <hr>
    </div>
</footer>
</html>



<!-- TOO SCARED TO SLEEP -->
<div class="modal fade" id="TooScaredToSleep" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header" style="background: #66CCCC;">
          <h5 class="modal-title" id="productModalLabel">TOO SCARED TO SLEEP</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
        </div>
        <div class="modal-body d-flex" style="background: #f6ba9c;">
          <img src="images/TooScaredToSleep.jpg" alt="Bìa sách" class="img-fluid me-4" style="max-width: 250px;">
          <div>
            <p><strong>Tác giả:</strong> Andrew Duplessie</p>
            <p><strong>Giá:</strong> <span class="text-danger fw-bold">150,000đ</span></p>
            <p><strong>Tình trạng:</strong> Còn hàng</p>
            <p><strong>Miêu tả:</strong> Câu chuyện đầy kịch tính với những tình tiết bất ngờ, khiến bạn phải dè chừng cả tiếng động nhỏ nhất quanh mình.</p>
            
          </div>
        </div>
        <div class="modal-footer" style="background: #66CCCC;">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button class="btn btn-danger" onclick="addToCart('TOO SCARED TO SLEEP', 150000, 'images/TooScaredToSleep.jpg')">
            Thêm vào giỏ hàng
          </button>
  
        </div>
      </div>
    </div>
</div>

<!-- The Buried -->
<div class="modal fade" id="TheBuried" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header" style="background: #66CCCC;">
          <h5 class="modal-title" id="productModalLabel">THE BURIED</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
        </div>
        <div class="modal-body d-flex" style="background: #f6ba9c;">
          <img src="images/TheBuried.jpg" alt="Bìa sách" class="img-fluid me-4" style="max-width: 250px;">
          <div>
            <p><strong>Tác giả:</strong> Melissa Grey</p>
            <p><strong>Giá:</strong> <span class="text-danger fw-bold">150,000đ</span></p>
            <p><strong>Tình trạng:</strong> Còn hàng</p>
            <p><strong>Miêu tả:</strong> Câu chuyện đầy kịch tính với những tình tiết bất ngờ, khiến bạn phải dè chừng cả tiếng động nhỏ nhất quanh mình.</p>
            
          </div>
        </div>
        <div class="modal-footer" style="background: #66CCCC;">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button class="btn btn-danger" onclick="addToCart('THE BURIED', 150000, 'images/TheBuried.jpg')">
            Thêm vào giỏ hàng
          </button>
  
        </div>
      </div>
    </div>
</div>

<!-- TAKE YOUR TURN TEDDY -->
<div class="modal fade" id="TakeYourTurnTeddy" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header" style="background: #66CCCC;">
          <h5 class="modal-title" id="productModalLabel">TAKE YOUR TURN TEDDY</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
        </div>
        <div class="modal-body d-flex" style="background: #f6ba9c;">
          <img src="images/TAKEYOURTURNTEDDY.jpg" alt="Bìa sách" class="img-fluid me-4" style="max-width: 250px;">
          <div>
            <p><strong>Tác giả:</strong> Haley Newlin</p>
            <p><strong>Giá:</strong> <span class="text-danger fw-bold">150,000đ</span></p>
            <p><strong>Tình trạng:</strong> Còn hàng</p>
            <p><strong>Miêu tả:</strong> Câu chuyện đầy kịch tính với những tình tiết bất ngờ, khiến bạn phải dè chừng cả tiếng động nhỏ nhất quanh mình.</p>
            
          </div>
        </div>
        <div class="modal-footer" style="background: #66CCCC;">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button class="btn btn-danger" onclick="addToCart('TAKE YOUR TURN TEDDY', 150000, 'images/TAKEYOURTURNTEDDY.jpg')">
            Thêm vào giỏ hàng
          </button>
  
        </div>
      </div>
    </div>
</div>

<!-- THE SILENCE OF THE LAMBS -->
<div class="modal fade" id="THESILENCEOFTHELAMBS" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header" style="background: #66CCCC;">
          <h5 class="modal-title" id="productModalLabel">THE SILENCE OF THE LAMBS</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Đóng"></button>
        </div>
        <div class="modal-body d-flex" style="background: #f6ba9c;">
          <img src="images/THESILENCEOFTHELAMBS.jpg" alt="Bìa sách" class="img-fluid me-4" style="max-width: 250px;">
          <div>
            <p><strong>Tác giả:</strong> Thomas Harris</p>
            <p><strong>Giá:</strong> <span class="text-danger fw-bold">150,000đ</span></p>
            <p><strong>Tình trạng:</strong> Còn hàng</p>
            <p><strong>Miêu tả:</strong> Câu chuyện đầy kịch tính với những tình tiết bất ngờ, khiến bạn phải dè chừng cả tiếng động nhỏ nhất quanh mình.</p>
            
          </div>
        </div>
        <div class="modal-footer" style="background: #66CCCC;">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
          <button class="btn btn-danger" onclick="addToCart('THE SILENCE OF THE LAMBS', 150000, 'images/THESILENCEOFTHELAMBS.jpg')">
            Thêm vào giỏ hàng
          </button>
  
        </div>
      </div>
    </div>
</div>
  