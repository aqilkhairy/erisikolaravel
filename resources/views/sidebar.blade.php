<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
      <li class="nav-item">
        <a id="item-dashboard" href="/dashboard" class="nav-link">
          <i class="nav-icon fas fa-user-circle"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>
        <li class="nav-item">
            <a id="item-konteks-organisasi" href="/konteks_organisasi" class="nav-link">
              <i class="fas fa-book nav-icon"></i>
              <p>Konteks Organisasi</p>
            </a>
          </li>
        <li class="nav-item">
            <a id="item-dokumen-daftar-risiko" href="/daftar_risiko" class="nav-link">
              <i class="fas fa-book-open nav-icon"></i>
              <p>Daftar Risiko</p>
            </a>
          </li>
        @can('isPengguna')
        <!--- PENGGUNA -->
      <li class="nav-header">MODUL PENGGUNA</li>
        <li id="tree-semakan" class="nav-item has-treeview menu-open">
            <a href="/#" class="nav-link">
              <i class="nav-icon fas fa-ellipsis-h"></i>
              <p>
                Semakan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a id="item-semakan-keberkesanan-tindakan" href="/keberkesanan_tindakan/semakan" class="nav-link">
                      <i class="fas fa-edit nav-icon"></i>
                      <p> Keberkesanan Tindakan</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a id="item-semakan-konteks-organisasi" href="/konteks_organisasi/semakan" class="nav-link">
                      <i class="fas fa-edit nav-icon"></i>
                      <p> Konteks Organisasi</p>
                    </a>
                  </li>
                <li class="nav-item">
                    <a id="item-semakan-daftar-risiko" href="/daftar_risiko/semakan" class="nav-link">
                      <i class="fas fa-edit nav-icon"></i>
                      <p> Daftar Risiko</p>
                    </a>
                  </li>
            </ul>
        </li>
        @endcan
        @can('isUrusetia')
        <!--- URUSETIA -->
      <li class="nav-header">MODUL URUSETIA</li>
        <li id="tree-tetapan" class="nav-item has-treeview menu-open ">
            <a href="/#" class="nav-link">
              <i class="nav-icon fas fa-ellipsis-h"></i>
              <p>
                Tetapan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a id="item-tetapan-keberkesanan-tindakan" href="/keberkesanan_tindakan/tetapan" class="nav-link">
                      <i class="fas fa-cog nav-icon"></i>
                      <p> Keberkesanan Tindakan</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a id="item-tetapan-konteks-organisasi" href="/konteks_organisasi/tetapan" class="nav-link">
                      <i class="fas fa-cog nav-icon"></i>
                      <p> Konteks Organisasi</p>
                    </a>
                  </li>
                <li class="nav-item">
                    <a id="item-tetapan-daftar-risiko" href="/daftar_risiko/tetapan" class="nav-link">
                      <i class="fas fa-cog nav-icon"></i>
                      <p> Daftar Risiko</p>
                    </a>
                </li>
            </ul>
        </li>
        @endcan
        @can('isJK')
        <!--- JK RISIKO -->
      <li class="nav-header">MODUL JAWATANKUASA RISIKO</li>
        <li id="tree-pengesahan" class="nav-item has-treeview menu-open">
            <a href="/#" class="nav-link">
              <i class="nav-icon fas fa-ellipsis-h"></i>
              <p>
                Pengesahan
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a id="item-pengesahan-keberkesanan-tindakan" href="/keberkesanan_tindakan/pengesahan" class="nav-link">
                      <i class="fas fa-clipboard-check nav-icon"></i>
                      <p>Keberkesanan Tindakan</p>
                    </a>
                  </li>
                <li class="nav-item">
                    <a id="item-pengesahan-konteks-organisasi" href="/konteks_organisasi/pengesahan" class="nav-link">
                      <i class="fas fa-clipboard-check nav-icon"></i>
                      <p>Konteks Organisasi</p>
                    </a>
                  </li>
                <li class="nav-item">
                    <a id="item-pengesahan-daftar-risiko" href="/daftar_risiko/pengesahan" class="nav-link">
                      <i class="fas fa-clipboard-check nav-icon"></i>
                      <p>Daftar Risiko</p>
                    </a>
                  </li>
            </ul>
        </li>
        <li id="tree-sejarah" class="nav-item has-treeview menu-open">
            <a href="/#" class="nav-link">
              <i class="nav-icon fas fa-ellipsis-h"></i>
              <p>
                Sejarah
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
        <ul class="nav nav-treeview">
            <li class="nav-item">
                <a id="item-sejarah-keberkesanan-tindakan" href="/keberkesanan_tindakan/sejarah" class="nav-link">
                  <i class="fas fa-history nav-icon"></i>
                  <p>Keberkesanan Tindakan</p>
                </a>
              </li>
          <li class="nav-item">
            <a id="item-sejarah-konteks-organisasi" href="/konteks_organisasi/sejarah" class="nav-link">
              <i class="fas fa-history nav-icon"></i>
              <p>Konteks Organisasi</p>
            </a>
          </li>
            <li class="nav-item">
                <a id="item-sejarah-daftar-risiko" href="/daftar_risiko/sejarah" class="nav-link">
                  <i class="fas fa-history nav-icon"></i>
                  <p>Daftar Risiko</p>
                </a>
              </li>
        </ul>
    </li>
        @endcan
    </ul>
  </nav>