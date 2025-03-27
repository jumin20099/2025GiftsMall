<?php
$slides = [
    [
        "src" => "/views/images/innovation1.jpg",
        "title" => "행복신뢰",
        "description" => "고객신뢰를 바탕으로 행복한 사회를 추구하는 글로벌 기업"
    ],
    [
        "src" => "/views/images/innovation2.jpg",
        "title" => "가치나눔",
        "description" => "기업의 가치 혁신의 출발은 나눔을 시작으로 고객 가치를 탐험한다."
    ],
    [
        "src" => "/views/images/innovation3.jpg",
        "title" => "환경선도",
        "description" => "세계 기후변화 대응을 위해 100% 재생에너지로 생산된 제품만 선별한다."
    ],
    [
        "src" => "/views/images/innovation4.jpg",
        "title" => "미래혁신",
        "description" => "다른 생각 다른 미래, 플랫폼 기반의 글로벌 미래 혁신을 선도한다."
    ],
    [
        "src" => "/views/images/innovation5.jpg",
        "title" => "정보보안",
        "description" => "글로벌 수준의 개인정보보호 및 보안 체계를 유지한다."
    ]
];
?>
<!DOCTYPE html>
<html lang="ko">
<head>
  <meta charset="UTF-8">
  <title>중간 소개 섹션 데모 - Title &amp; Description Overlay</title>
  <style>
    body {
      margin: 0;
      font-family: sans-serif;
      background: #fff;
    }
    .intro-section {
      width: 100%;
      max-width: 1200px;
      margin: 0 auto;
      padding: 60px 20px;
    }
    .intro-section h2 {
      text-align: center;
      margin-bottom: 40px;
      font-size: 2rem;
    }
    .intro-section p {
      text-align: center;
      font-size: 1.1rem;
      margin-bottom: 40px;
    }
    .slices-container {
      display: flex;
      gap: 5px;
      width: 100%;
      height: 400px;
      overflow: hidden;
      background-color: #f0f0f0;
      position: relative;
    }
    .slice {
      position: relative;
      flex: 1;
      background-repeat: no-repeat;
      background-size: 500% auto;
      transition: background 0.3s ease;
      cursor: pointer;
    }
    .slice:hover {
      filter: brightness(1.1);
    }
    .title-overlay {
      position: absolute;
      bottom: 10px;
      left: 10px;
      color: #fff;
      font-size: 1.2rem;
      text-shadow: 1px 1px 3px rgba(0,0,0,0.7);
      z-index: 2;
    }
    .desc-overlay {
      position: absolute;
      top: 10px;
      right: 10px;
      color: #fff;
      font-size: 1rem;
      text-shadow: 1px 1px 3px rgba(0,0,0,0.7);
      width: 60%;
      text-align: right;
      line-height: 1.4;
      z-index: 2;
      display: none;
    }
    .slices-container.hovered .slice:not(.active) .title-overlay {
      display: none;
    }
    /* 호버 상태일 때 5번째 슬라이스의 description 오버레이 보이기 */
    .slices-container.hovered .slice:nth-child(5) .desc-overlay {
      display: block;
    }
  </style>
</head>
<body>

<section class="intro-section">
  <h2>우리가 만들어가는 미래</h2>
  <p>행복신뢰, 가치나눔, 환경선도, 미래혁신, 정보보안의 5가지 가치를 통해 미래를 이끌어갑니다.</p>
  
  <div class="slices-container" id="slicesContainer">
    <?php 
      foreach ($slides as $index => $slide): 
        $bgPos = (25 * $index) . '% 0';  // 0%, 25%, 50%, 75%, 100%
    ?>
      <div class="slice"
           data-index="<?= $index ?>"
           data-image="<?= $slide['src'] ?>"
           data-title="<?= htmlspecialchars($slide['title']) ?>"
           data-description="<?= htmlspecialchars($slide['description']) ?>"
           style="background-image: url('<?= $slide['src'] ?>'); background-position: <?= $bgPos ?>;">
        <div class="title-overlay"><?= $slide['title'] ?></div>
        <?php if ($index === 4): ?>
          <div class="desc-overlay"></div>
        <?php endif; ?>
      </div>
    <?php endforeach; ?>
  </div>
</section>

<script>
  const slicesContainer = document.getElementById('slicesContainer');
  const slices = document.querySelectorAll('.slice');
  const defaultConfig = [];

  // 각 슬라이스의 기본 상태(배경 이미지 및 배경 위치)를 저장
  slices.forEach((slice, i) => {
    defaultConfig[i] = {
      backgroundImage: slice.style.backgroundImage,
      backgroundPosition: slice.style.backgroundPosition
    };

    slice.addEventListener('mouseenter', function() {
      // 모든 슬라이스의 active 클래스를 제거한 후 현재 슬라이스에 active 추가
      slices.forEach(s => s.classList.remove('active'));
      this.classList.add('active');
      slicesContainer.classList.add('hovered');

      const hoveredImage = this.getAttribute('data-image');
      const hoveredDescription = this.getAttribute('data-description');
      
      // 전체 슬라이스를 호버한 이미지의 5등분 조각으로 업데이트
      slices.forEach((otherSlice, j) => {
        otherSlice.style.backgroundImage = `url(${hoveredImage})`;
        otherSlice.style.backgroundPosition = `${j * 25}% 0`;
      });
      // 5번째 슬라이스의 description 오버레이 업데이트
      const descOverlay = slicesContainer.querySelector('.slice:nth-child(5) .desc-overlay');
      if (descOverlay) {
        descOverlay.textContent = hoveredDescription;
      }
    });
  });

  // 컨테이너에서 마우스가 완전히 벗어나면 기본 상태로 복원
  slicesContainer.addEventListener('mouseleave', function() {
    slicesContainer.classList.remove('hovered');
    slices.forEach((slice, k) => {
      slice.classList.remove('active');
      slice.style.backgroundImage = defaultConfig[k].backgroundImage;
      slice.style.backgroundPosition = defaultConfig[k].backgroundPosition;
    });
  });
</script>

</body>
</html>