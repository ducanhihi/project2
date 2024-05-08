
    <div class="container">
        <h3>Giỏ Hàng</h3>
        <table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Tên Sản Phẩm</th>
                <th>Giá</th>
                <th>Số Lượng</th>
                <th>Tổng</th>
                <th>Xóa</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>1</td>
                <td>Laptop Dell XPS 15</td>
                <td>$1,499.99</td>
                <td>
                    <div class="input-group" style="max-width: 200px;">
                        <button class="btn btn-outline-secondary" type="button">-</button>
                        <input type="text" class="form-control text-center" value="1">
                        <button class="btn btn-outline-secondary" type="button">+</button>
                    </div>
                </td>
                <td>$1,499.99</td>
                <td><a href="#" class="btn btn-danger btn-sm">Xóa</a></td>
            </tr>
            <tr>
                <td>2</td>
                <td>Macbook Pro 16-inch</td>
                <td>$2,399.99</td>
                <td>
                    <div class="input-group" style="max-width: 200px;">
                        <button class="btn btn-outline-secondary" type="button">-</button>
                        <input type="text" class="form-control text-center" value="1">
                        <button class="btn btn-outline-secondary" type="button">+</button>
                    </div>
                </td>
                <td>$2,399.99</td>
                <td><a href="#" class="btn btn-danger btn-sm">Xóa</a></td>
            </tr>
            </tbody>
        </table>

        <h4>Tổng Tiền: $3,899.98</h4>
        <br>
        <h4>Đặt Hàng</h4>
        <form action="#" method="post" class="container">
            <div class="mt-3 mb-3">
                <label for="fullName">Họ Tên</label>
                <input type="text" required style="width: 500px" name="fullName" id="fullName" class="form-control form-control-sm">
            </div>

            <div class="mt-3 mb-3">
                <label for="phone">Số Điện Thoại</label>
                <input type="text" required style="width: 500px" name="phone" id="phone" class="form-control form-control-sm">
            </div>

            <div class="mt-3 mb-3">
                <label for="address">Địa Chỉ</label>
                <input type="text" required style="width: 500px" name="address" id="address" class="form-control form-control-sm">
            </div>
            <button class="fa-solid fa-bag-shopping fa-bounce">Đặt Hàng</button>
        </form>
    </div>

