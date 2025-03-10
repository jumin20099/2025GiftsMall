const motos = document.querySelectorAll('.motos');
        
motos.forEach(moto => {
    moto.addEventListener('mouseenter', () => {
        const image = moto.getAttribute('data-image-url');
        motos.forEach((b, index) => {
            b.style.backgroundImage = `url(${image})`;
            b.style.backgroundPosition = `-${index * 300}px center`;
        });
    });
    
    moto.addEventListener('mouseleave', () => {
        motos.forEach(b => b.style.backgroundImage = '');
    });
});

// 비회원 주문 버튼 클릭 시 모달 열기
const guestOrderBtn = document.getElementById('guestOrderBtn');
const modal = document.getElementById('modal');
const closeModalBtn = document.getElementById('closeModalBtn');
const guestIdElement = document.getElementById('guestId');
const orderArea = document.getElementById('order-area');
const totalAmountElement = document.getElementById('totalAmount');

// 주문한 상품 목록을 저장할 배열
let orderItems = []; 

// 상품 정보 하드코딩 (이름, 가격, 이미지)
const productsInfo = [
  { name: '상품1', price: 10000, image: '../선수제공파일/공통/images/03.jpg' },
  { name: '상품2', price: 5000, image: '../선수제공파일/공통/images/04.jpg' },
  { name: '상품3', price: 8000, image: '../선수제공파일/공통/images/05.jpg' },
];

// 비회원 ID 생성 (랜덤 6자리)
function generateGuestId() {
  return Math.random().toString(36).substring(2, 8).toUpperCase(); // 랜덤으로 6자리 ID 생성
}

// 모달 열기
guestOrderBtn.addEventListener('click', function() {
  modal.style.display = 'block'; // 모달 보이기
  guestIdElement.textContent = generateGuestId(); // 생성된 ID 표시
});

// 모달 닫기
closeModalBtn.addEventListener('click', function() {
  modal.style.display = 'none'; // 모달 숨기기
});

// 상품을 드래그할 수 있도록 설정
const products = document.querySelectorAll('.product');
products.forEach(function(product, index) {
  product.setAttribute('draggable', 'true'); // 상품을 드래그할 수 있게 설정
  product.addEventListener('dragstart', function(e) {
    e.dataTransfer.setData('text', index); // 상품의 인덱스를 저장
    // 상품 반투명 처리 (전시 영역에서)
    e.target.style.opacity = '0.5'; 
  });

  product.addEventListener('dragend', function(e) {
    e.target.style.opacity = '1'; // 드래그가 끝난 후 원래 상태로 복원
  });
});

// 주문 영역에 상품 드롭하기
orderArea.addEventListener('dragover', function(e) {
  e.preventDefault(); // 기본 동작 방지 (드래그가 가능하게 만듦)
});

orderArea.addEventListener('drop', function(e) {
  e.preventDefault();

  // 드래그된 상품의 인덱스 가져오기
  const productIndex = e.dataTransfer.getData('text');
  const product = productsInfo[productIndex]; // 하드코딩된 상품 정보에서 해당 상품 가져오기

  // 새 상품 요소 만들기
  const productElement = document.createElement('div');
  productElement.classList.add('product-item');
  
  // 이미지, 이름, 가격을 포함한 상품 정보 HTML 생성
  productElement.innerHTML = `
    <img src="${product.image}" alt="${product.name}" width="50" height="50">
    <p>${product.name}: ${product.price}원</p>
  `;
  
  orderArea.appendChild(productElement); // 주문 영역에 추가

  // 하드코딩된 상품을 주문 목록에 추가
  orderItems.push({ name: product.name, price: product.price });

  updateTotalAmount(); // 총 금액 업데이트
});

// 총 결제 금액 업데이트
function updateTotalAmount() {
  let total = 0;
  orderItems.forEach(function(item) {
    total += item.price; // 각 상품의 가격 합산
  });
  totalAmountElement.textContent = total; // 화면에 총 금액 표시
}

// 주문하기 버튼 클릭 시
const orderBtn = document.getElementById('orderBtn');
orderBtn.addEventListener('click', function() {
  modal.style.display = 'none'; // 모달 닫기
  setTimeout(function() {
    alert(`방금 비회원 ${guestIdElement.textContent}님이 ${totalAmountElement.textContent}을 결제하셨습니다!`);
  }, 1000);
});

// 주문 영역에서 드래그한 상품이 영역 밖으로 나갔을 때 상품 삭제 및 주문 목록에서 제거
modal.addEventListener('dragleave', function(e) {
  const productElement = e.target;
  if (productElement.classList.contains('product-item')) {
    // 주문 목록에서 해당 상품을 제거
    const index = orderItems.findIndex(item => item.name === productElement.querySelector('p').textContent.split(':')[0]);
    if (index !== -1) {
      orderItems.splice(index, 1); // 배열에서 제거
      productElement.remove(); // 화면에서 상품 제거
      updateTotalAmount(); // 금액 갱신
    }

    // 전시 영역에서 반투명 처리된 상품 복원
    const productName = productElement.querySelector('p').textContent.split(':')[0];
    const originalProduct = Array.from(products).find(prod => prod.querySelector('p').textContent === productName);
    if (originalProduct) {
      originalProduct.style.opacity = '1'; // 상품 복원
    }
  }
});