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
let orderItems = []; // 주문한 상품 목록

// 비회원 ID 생성 (랜덤 6자리)
function generateGuestId() {
  return Math.random().toString(36).substring(2, 8).toUpperCase();
}

// 모달 열기
guestOrderBtn.addEventListener('click', () => {
  modal.style.display = 'block';
  guestIdElement.textContent = generateGuestId();
});

// 모달 닫기
closeModalBtn.addEventListener('click', () => {
  modal.style.display = 'none';
});

// 드래그 앤 드롭 처리
const products = document.querySelectorAll('.product');
products.forEach(product => {
  product.addEventListener('dragstart', (e) => {
    e.dataTransfer.setData('text', e.target.innerHTML);
    e.target.classList.add('dragged');
  });

  product.addEventListener('dragend', (e) => {
    e.target.classList.remove('dragged');
  });
});

// 드래그가 주문 영역 밖으로 벗어날 때
orderArea.addEventListener('dragover', (e) => {
  e.preventDefault(); // 기본 동작 방지
});

// 상품이 드래그 앤 드롭되어 주문영역에 추가
orderArea.addEventListener('drop', (e) => {
  e.preventDefault();
  const data = e.dataTransfer.getData('text');
  const productElement = document.createElement('div');
  productElement.innerHTML = data;
  orderArea.appendChild(productElement);

  // 상품 정보 추가
  const productPrice = parseInt(productElement.querySelector('p').textContent.split(':')[1].replace('원', '').trim());
  const productName = productElement.querySelector('p').textContent;

  // 주문 항목 배열에 추가
  orderItems.push({ name: productName, price: productPrice, quantity: 1 });

  // 전시 영역 상품 반투명 처리
  e.target.classList.add('dragged');

  updateTotalAmount();
});

// 주문영역 밖으로 드래그되었을 때 상품 삭제 및 주문 목록에서 제거
orderArea.addEventListener('dragleave', (e) => {
  const productElement = e.target;
  if (productElement && productElement.classList.contains('dragged')) {
    // 주문 영역에서 드래그된 상품을 제거
    const index = orderItems.findIndex(item => item.name === productElement.querySelector('p').textContent);
    if (index !== -1) {
      orderItems.splice(index, 1); // 주문 목록에서 제거
      productElement.remove(); // 화면에서 상품 삭제
      updateTotalAmount(); // 금액 갱신
    }
  }
});

// 총 결제 금액 업데이트
function updateTotalAmount() {
  let total = 0;
  orderItems.forEach(item => {
    total += item.price * item.quantity;
  });
  totalAmountElement.textContent = total;
}

// 주문하기 버튼 클릭
const orderBtn = document.getElementById('orderBtn');
orderBtn.addEventListener('click', () => {
  modal.style.display = 'none';
  setTimeout(() => {
    alert(`방금 비회원 ${guestIdElement.textContent}님이 ${totalAmountElement.textContent}원을 결제하셨습니다!`);
  }, 1000);
});
