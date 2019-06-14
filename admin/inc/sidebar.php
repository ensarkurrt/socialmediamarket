<!-- partial:partials/_sidebar.html -->
<nav class="sidebar sidebar-offcanvas" id="sidebar">
  <ul class="nav">
    <li class="nav-item nav-profile">
      <div class="nav-link">
        <div class="user-wrapper">
          <div class="profile-image">
            <img src="images/faces/face1.jpg" alt="profile image">
          </div>
          <div class="text-wrapper">
            <p class="profile-name"><?php echo $takeUserInfo['username']; ?></p>
            <div>
              <small class="designation text-muted">Yönetici</small>
              <span class="status-indicator online"></span>
            </div>
          </div>
        </div>

      </div>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="index">
        <i class="menu-icon mdi mdi-home"></i>
        <span class="menu-title">Anasayfa</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="settings">
        <i class="menu-icon mdi mdi-settings"></i>
        <span class="menu-title">Ayarlar</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="tickets">
        <i class="menu-icon mdi mdi-message-reply-text"></i>
        <span class="menu-title">Ticketlar</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="categories">
        <i class="menu-icon mdi mdi-format-list-bulleted"></i>
        <span class="menu-title">Kategoriler</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" href="services">
        <i class="menu-icon mdi mdi-format-list-bulleted"></i>
        <span class="menu-title">Servisler</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
        <i class="menu-icon mdi mdi-credit-card"></i>
        <span class="menu-title">Ödeme Seçenekleri</span>
        <i class="menu-arrow"></i>
      </a>
      <div class="collapse" id="auth">
        <ul class="nav flex-column sub-menu">
          <li class="nav-item">
            <a class="nav-link" href="shopierlinks"> Shopier Linkleri </a>
          </li>
        </ul>
      </div>
    </li>
  </ul>
</nav>
