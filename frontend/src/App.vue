<script setup>


</script>

<template>
  <header>
    <div class="wrapper header">
      <RouterLink to="/">Меняйкин</RouterLink>
      <nav class="header-nav">
        <a href="#contacts">Контакты</a>
        <RouterLink to="/login">Войти</RouterLink>
      </nav>
    </div>
  </header>

  <RouterView />

  <footer id="contacts">
    <div class="wrapper footer">
      <RouterLink to="/announcements">Объявления</RouterLink>
      <nav>
        <a href="#"><img class="footer-icon" src="@/assets/images/tg-icon.svg" alt="tg-icon"></a>
        <a href="#"><img class="footer-icon" src="@/assets/images/vk-icon.svg" alt="vk-icon"></a>
      </nav>
    </div>
  </footer>
</template>

<style>
@import "assets/main.css";
.header{
  display: flex;
  justify-content: space-between;
  font-size: 36px;
  padding: 25px 0;
}
.header-nav{
  display: flex;
  gap: 40px;
}
footer{
  background: var(--border);
}
.footer{
  display: flex;
  flex-direction: column;
  gap: 50px;
}
.footer-icon{
  width: 50px;
  height: 50px;
}

</style>
