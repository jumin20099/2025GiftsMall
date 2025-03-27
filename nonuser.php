<?php
$productsJson = '[
    {
        "name": "이뮨 멀티비타민&미네랄",
        "description": "국내 판매 1위 멀티비타민 이뮨 14일분에 이중제형 + 남/녀 맞춤설계 포뮬러를 적용한 신제품",
        "price": "75,000 65,000",
        "delivery": "2,500원 (20,000원 이상 무료배송)",
        "discount": "GIFTS카드 추가 10% 할인",
        "point": "GiftsMall 포인트 최대 1% 적립"
    },
    {
        "name": "센트룸",
        "description": "생기 넘치는 일상을 위한 센트룸 우먼 더블업. 비타민 B군 8종 함량 2배, 23가지 비타민과 미네랄, 한국인 여성 맞춤 영양 설계",
        "price": "27000",
        "delivery": "2,500원 (20,000원 이상 무료배송)",
        "discount": "GIFTS카드 추가 10% 할인",
        "point": "GiftsMall 포인트 최대 1% 적립"
    },
    {
        "name": "닥터브라이언",
        "description": "달콤한 청포도맛 구미로 맛있게 비타민 C와 D를 충전하세요. 활기찬 하루와 튼튼한 뼈 건강을 맛있게 충전하는 부드러운 젤리 타입",
        "price": "2000",
        "delivery": "2,500원 (20,000원 이상 무료배송)",
        "discount": "GIFTS카드 추가 10% 할인",
        "point": "GiftsMall 포인트 최대 1% 적립"
    },
    {
        "name": "액티브 멀티포맨",
        "description": "미국판매 1위 내셔널 건강기능식품 브랜드. 남성 건강을 생각하는 22가지 주요 비타민&미네랄",
        "price": "30000",
        "delivery": "2,500원 (20,000원 이상 무료배송)",
        "discount": "GIFTS카드 추가 10% 할인",
        "point": "GiftsMall 포인트 최대 1% 적립"
    },
    {
        "name": "네이처메이드B12",
        "description": "여성 건강을 생각하는 23가지 주요 비타민&미네랄, 한국인 1일 영양 권장량을 고려한 철분, 엽산이 강화된 여성종합비타민",
        "price": "30000",
        "delivery": "2,500원 (20,000원 이상 무료배송)",
        "discount": "GIFTS카드 추가 10% 할인",
        "point": "GiftsMall 포인트 최대 1% 적립"
    }
]';

// JSON 데이터를 PHP 배열로 변환
$products = json_decode($productsJson, true);

// 비회원 랜덤 ID(영숫자 6자리) 생성
$non_member_id = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"), 0, 6);
?>
  <style>
    body { font-family: Arial, sans-serif; }
    .product-page { padding: 20px; }
    .all-products { display: flex; flex-wrap: wrap; }
    .product-item {
      border: 1px solid #ccc; padding: 10px; margin: 10px;
      width: 150px; text-align: center;
    }
    .modal-overlay {
      position: fixed; top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.5);
      z-index: 1000; display: none;
    }
    .modal {
      background: #fff; width: 80%; max-width: 800px;
      margin: 50px auto; padding: 20px; position: relative;
      /* 내부 모달은 항상 block */
      display: block;
    }
    .modal-header {
      display: flex; justify-content: space-between; align-items: center;
    }
    .modal-content {
      display: flex; flex-wrap: wrap; gap: 20px;
    }
    .member-info, .display-area, .order-area, .payment-area {
      border: 1px solid #ddd; padding: 10px;
    }
    .member-info { flex: 1 1 100%; }
    .display-area { flex: 1 1 45%; max-height: 300px; overflow-y: auto; }
    .order-area { flex: 1 1 45%; max-height: 300px; overflow-y: auto; }
    .payment-area { flex: 1 1 100%; text-align: right; }
    .product-list .product {
      border: 1px solid #ccc; margin: 5px; padding: 5px;
      cursor: move;
    }
    .product-image {
      width: 100px; height: 100px;
      background: #eee; margin-bottom: 5px;
      display: flex; align-items: center; justify-content: center;
    }
    #order-table { width: 100%; border-collapse: collapse; }
    #order-table th, #order-table td {
      border: 1px solid #ccc; padding: 5px; text-align: center;
    }
    #order-message {
      background: #ddd; padding: 10px; margin-top: 20px; display: none;
    }
    .close-modal { cursor: pointer; }
  </style>
</head>
<body>
  <!-- 전체상품 페이지 -->
  <div class="product-page">
    <h1>전체상품</h1>
    <div class="all-products">
      <?php foreach ($products as $index => $product): ?>
        <div class="product-item">
          <div class="product-image">[이미지]</div>
          <div class="product-name"><?php echo $product['name']; ?></div>
        </div>
      <?php endforeach; ?>
    </div>
    <button id="open-modal-btn">비회원주문</button>
    <div id="order-message"></div>
  </div>

  <!-- 모달 페이지 -->
  <div id="modal-overlay" class="modal-overlay">
    <div class="modal">
      <div class="modal-header">
        <h2>비회원 주문</h2>
        <span id="close-modal" class="close-modal">X</span>
      </div>
      <div class="modal-content">
        <!-- 회원정보 -->
        <div class="member-info">
          <p>비회원 ID: <span id="non-member-id"><?php echo $non_member_id; ?></span></p>
        </div>
        <!-- 전체상품 -->
        <div class="display-area">
          <h3>전체상품</h3>
          <div class="product-list">
            <?php foreach($products as $index => $product): ?>
              <div class="product" draggable="true" data-index="<?php echo $index; ?>">
                <div class="product-image">[이미지]</div>
                <div class="product-name"><?php echo $product['name']; ?></div>
                <div class="product-description"><?php echo $product['description']; ?></div>
                <div class="product-price" data-price="<?php echo $product['price']; ?>"><?php echo $product['price']; ?></div>
              </div>
            <?php endforeach; ?>
          </div>
        </div>
        <!-- 주문 -->
        <div class="order-area" id="order-area" ondragover="allowDrop(event)" ondrop="dropOrder(event)">
          <h3>주문</h3>
          <table id="order-table">
            <thead>
              <tr>
                <th>사진</th>
                <th>상품명</th>
                <th>수량</th>
                <th>단가</th>
                <th>금액</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
        <!-- 결제영역 -->
        <div class="payment-area">
          <h3>결제영역</h3>
          <p>총 결제금액: <span id="total-amount">0</span>원</p>
          <button id="order-button">주문하기</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      // PHP의 제품 데이터를 JavaScript 변수에 할당
      var products = <?php echo json_encode($products); ?>;
      
      // 제품 가격 문자열에서 마지막 토큰(콤마 제거 후 정수) 추출
      function parsePrice(priceStr) {
        var tokens = priceStr.split(" ");
        var last = tokens[tokens.length-1].replace(/,/g, "");
        return parseInt(last);
      }
  
      var draggedProductIndex = null;
      var orderItems = {};
  
      // 드롭 영역 기본 설정
      function allowDrop(ev) {
        ev.preventDefault();
      }
  
      // 전시영역의 제품 드래그 시작
      function productDragStart(ev) {
        draggedProductIndex = ev.target.getAttribute('data-index');
        ev.dataTransfer.setData("text/plain", draggedProductIndex);
      }
  
      // 주문영역에 드롭 시 실행
      function dropOrder(ev) {
        ev.preventDefault();
        if(!ev.dataTransfer.getData("fromOrder")){
          var index = ev.dataTransfer.getData("text/plain");
          addToOrder(index);
        }
      }
  
      // 전시영역의 제품들을 주문영역에 추가
      function addToOrder(index) {
        if(orderItems[index]) {
          orderItems[index].quantity++;
          updateOrderRow(index);
        } else {
          orderItems[index] = {
            quantity: 1,
            unitPrice: parsePrice(products[index].price)
          };
          var tbody = document.querySelector("#order-table tbody");
          var tr = document.createElement("tr");
          tr.setAttribute("data-index", index);
          tr.setAttribute("draggable", "true");
          tr.addEventListener("dragstart", orderRowDragStart);
          tr.innerHTML = '<td>[이미지]</td>' +
                         '<td>' + products[index].name + '</td>' +
                         '<td><input type="number" min="1" value="1" style="width:50px;" onchange="quantityChanged(this, \''+ index +'\')"></td>' +
                         '<td>' + orderItems[index].unitPrice + '</td>' +
                         '<td class="line-total">' + orderItems[index].unitPrice + '</td>';
          tbody.appendChild(tr);
          var prodElem = document.querySelector('.product[data-index="'+ index +'"]');
          if(prodElem) { prodElem.style.opacity = "0.5"; }
        }
        updateTotalAmount();
      }
  
      function updateOrderRow(index) {
        var tbody = document.querySelector("#order-table tbody");
        var tr = tbody.querySelector('tr[data-index="'+ index +'"]');
        if(tr) {
          var qtyInput = tr.querySelector("input[type='number']");
          var quantity = orderItems[index].quantity;
          qtyInput.value = quantity;
          var lineTotal = quantity * orderItems[index].unitPrice;
          tr.querySelector(".line-total").innerText = lineTotal;
        }
        updateTotalAmount();
      }
  
      window.quantityChanged = function(inputElem, index) {
        var quantity = parseInt(inputElem.value);
        if(isNaN(quantity) || quantity < 1) {
          quantity = 1;
          inputElem.value = quantity;
        }
        orderItems[index].quantity = quantity;
        updateOrderRow(index);
      }
  
      function updateTotalAmount() {
        var total = 0;
        for(var index in orderItems) {
          total += orderItems[index].quantity * orderItems[index].unitPrice;
        }
        document.getElementById("total-amount").innerText = total;
      }
  
      function removeFromOrder(index) {
        var tbody = document.querySelector("#order-table tbody");
        var tr = tbody.querySelector('tr[data-index="'+ index +'"]');
        if(tr) { tbody.removeChild(tr); }
        delete orderItems[index];
        var prodElem = document.querySelector('.product[data-index="'+ index +'"]');
        if(prodElem) { prodElem.style.opacity = "1"; }
        updateTotalAmount();
      }
  
      document.querySelectorAll(".product").forEach(function(elem) {
        elem.addEventListener("dragstart", productDragStart);
      });
  
      function orderRowDragStart(ev) {
        draggedProductIndex = ev.target.getAttribute('data-index');
        ev.dataTransfer.setData("text/plain", draggedProductIndex);
        ev.dataTransfer.setData("fromOrder", "true");
      }
  
      document.getElementById("modal-overlay").addEventListener("drop", function(ev) {
        ev.preventDefault();
        if(ev.dataTransfer.getData("fromOrder") === "true") {
          var orderArea = document.getElementById("order-area");
          if(!orderArea.contains(ev.target)) {
            var index = ev.dataTransfer.getData("text/plain");
            removeFromOrder(index);
          }
        }
      });
  
      // 모달 열기/닫기 이벤트
      document.getElementById("open-modal-btn").addEventListener("click", function(){
        document.getElementById("modal-overlay").style.display = "block";
        // 내부 모달도 display:block 으로 설정
        document.querySelector(".modal").style.display = "block";
      });
      document.getElementById("close-modal").addEventListener("click", function(){
        document.getElementById("modal-overlay").style.display = "none";
        document.querySelector(".modal").style.display = "none";
      });
  
      document.getElementById("order-button").addEventListener("click", function(){
        var nonMemberID = document.getElementById("non-member-id").innerText;
        var totalAmount = document.getElementById("total-amount").innerText;
        document.getElementById("modal-overlay").style.display = "none";
        var messageDiv = document.getElementById("order-message");
        messageDiv.innerText = "방금 비회원 " + nonMemberID + "님이 " + totalAmount + "원을 결제하셨습니다!";
        messageDiv.style.display = "block";
        setTimeout(function(){ messageDiv.style.display = "none"; }, 3000);
        resetModal();
      });
  
      function resetModal() {
        orderItems = {};
        document.querySelector("#order-table tbody").innerHTML = "";
        document.querySelectorAll(".product").forEach(function(elem) {
          elem.style.opacity = "1";
        });
      }
  
      window.allowDrop = allowDrop;
      window.dropOrder = dropOrder;
    });
  </script>    
  </body>
