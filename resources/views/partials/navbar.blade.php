<header class="navbar sticky-top flex-md-nowrap p-0 shadow" style="background-color: #fff;">
    <a class="navbar-brand col-md-11 col-lg-12 me-0 py-2 px-3" href="" style="background-color: #fff;">
        <span><img src="{{ asset('img/Kemenkumham.png') }}" class="mb-2 mx-1 mt-1" style="width: 40px; height: 40px; margin-left: -5px; color: #000;"></span>
        <h1 style="font-size: 20px; margin-left: 55px; margin-top: -49px; font-weight: bold;">E-Presensi</h1>
        <p style="margin-left: 55px; margin-top: -10px; margin-bottom: 0px; font-size: 15px; font-weight: bold;">Kumham Jateng</p>
        <span>
            <p id="userName" style="position: absolute; margin-top: -40px; right: 100px; font-weight: bold;">Hallo {{ auth()->user()->name }}</p>
            <div id="uploadBox" class="position-absolute top-0 end-0" style="margin-top: 5px; border: transparent; padding: 0px; width: 55px; height: 55px; position: relative; overflow: hidden; margin-right: 30px; border-radius: 50%;">
                <label for="photoInput" style="cursor: pointer;">
                    <div id="userPhotoContainer" style="width: 100%; height: 100%; object-fit: cover;">
                        <img id="userPhoto" src="{{ asset('img/kucing.jpeg') }}" alt="User Photo" class="img-fluid" width="100">
                    </div>
                </label>
                <input id="photoInput" type="file" style="display: none;">
            </div>
        </span>
    </a>
    <button class="navbar-toggler position-absolute d-md-none bg-primary collapsed mt-2 border-0 navbar-light" type="button"
        data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
</header>

<script>
    const photoInput = document.getElementById('photoInput');
    const userPhoto = document.getElementById('userPhoto');
    const userName = document.getElementById('userName');

    const storageKey = 'userPhoto_' + userName.innerText.trim();

    photoInput.addEventListener('change', function () {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                userPhoto.src = e.target.result;
                localStorage.setItem(storageKey, e.target.result);
            };

            reader.readAsDataURL(file);
        }
    });

    const storedPhoto = localStorage.getItem(storageKey);
    if (storedPhoto) {
        userPhoto.src = storedPhoto;
    }
</script>
