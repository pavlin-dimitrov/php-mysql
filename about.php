<?php
include('includes/header.php');
?>

<?php
if (isset($_POST['home'])) {
  header('Location: index.php');
}
?>

<div id="hero-about">
      <div class="texture"></div>
      <div class="about-background-image"></div>
  <div id="content-about">
      <form method="post">
        <div><input class="log-btn btn-home" type="submit" name="home" value="Home"></div>
      </form>
        <h1>ABOUT THE GAME</h1>
    <div class="row1">
        <div class="info-item-about info-item-bg"><span class="game-gen-info">Всяка петък вечер група от супер-cool програмисти се събират за да играят любимата си бордова игра - "IT Village". Те толкова са уморени от кодиране през седмицата, че непрекъснато забравят правилата на програмата. Също така им е много трудно да работят с хартия и да хвърлят зарчета и взимат едно много важно решение - играта трябва да бъда развита и превърната в компютърна игра.</span></div>
          <div class="space"></div>
        <div class="info-item-about info-item-bg"><span class="game-gen-info">Стартирате играта от входната позиция или от едно от полетата за игра и хвърляте зарчето. Ходовете са по посока на часовниковата стрелка.<br><b>Печелите играта ако:</b><br>Стъпите на поле VSO<br>Купите 3 мотела<br><b>Губите играта ако:</b><br>Останете без пари или ходове.</span></div>
          <div class="space"></div>
       <div class="info-item-about info-item-bg">
          <img alt="bar" class="info-pic" src="images/bar.png">
            <br>
            <span class="game-info gi-position">Wi-Fi кръчма: Трябва да си купите един Cloud Коктейл (-5 монети)</span>
       </div>
         <div class="space"></div>
       <div class="info-item-about info-item-bg">
          <img alt="motel" class="info-pic" src="images/hotel.png">
            <br>
              <span class="game-info gi-position">Wi-Fi мотел: Ако имате достатъчно пари, трябва да го купите (-100 монети). Ако не - трябва да си платите за престоя (-10 монети)</span>
       </div>
    </div>
      <div class="space"></div>
    <div class="row2">
       <div class="info-item-about info-item-bg">
          <img alt="freelance" class="info-pic" src="images/freelance.png">
            <br>
              <span class="game-info gi-position">Freelance Project: Получавате заплащане за работата си (+20 монети)</span>
       </div>
          <div class="space"></div>
       <div class="info-item-about info-item-bg">
          <img alt="storm" class="info-pic" src="images/storm.png">
            <br>
              <span class="game-info gi-position">Буря: Wi-Fi в селото умира и вие се депресирате и изпускате 2 хода.</span>
       </div>
          <div class="space"></div>
       <div class="info-item-about info-item-bg">
          <img alt="superphp" class="info-pic" src="images/superphp.png">
            <br>
              <span class="game-info gi-position">Супер РНР: Монетите ви се увеличават 10 пъти</span>
       </div>
          <div class="space"></div>
       <div class="info-item-about info-item-bg">
          <img alt="vso" class="info-pic" src="images/vso.png">
            <br>
              <span class="game-info gi-position">VSO: Ако стъпите на това поле - печелите играта</span>
       </div>
     </div>
  </div>
</div>


<?php
include('includes/footer.php');
?>