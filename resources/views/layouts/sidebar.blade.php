<link rel="stylesheet" href="{{ asset('css/sidebar.css') }}">
<section>
    <!-- whole -->

    <div class="lists">
        <ul>

            <li>
                <a href="{{ route('tasks') }}">
                    <ion-icon name="chevron-back-sharp"></ion-icon>
                    Tasks
                </a>
            </li>
            <li>
                <a href="{{ route('dashboard') }}">
                    <ion-icon name="chevron-back-sharp"></ion-icon>
                    Dashboard
                </a>
            </li>
            <li>
                <a href="{{ route('projects') }}">
                    <ion-icon name="chevron-back-sharp"></ion-icon>
                    Projects
                </a>
            </li>
            <li>
                <a href="{{ route('profile') }}">
                    <ion-icon name="chevron-back-sharp"></ion-icon>
                    Profile
                </a>
            </li>
            <li>

                <a id="openModalBtn">
                    Logout
                    <ion-icon name="chevron-back-sharp"></ion-icon>

                </a>
                <div id="modal" class="modal">
                    <div class="modal-content">

                        <h2>Realy Want to Logout??</h2>
                        <span>

                            <form action="{{ route('logout') }}" method="POST" class="logout">
                                @csrf
                                <button type="submit" name="lg_btn">Logout</button>
                            </form>

                            <button id="closeModalBtn">Cancel</button>
                        </span>
                    </div>





                </div>
            </li>


        </ul>
    </div>

    <div class="whole">

        <!-- left -->
        <div class="left-section">

            <div class="logo pt-3 pb-3 d-flex gap-2 wrap border-bottom">
                <img src="logo.png" class=" height"> <span class="none">Time Teracker</span>

                <div class="toggle" onclick="toggle()"> <ion-icon name="chevron-back-sharp" id="iconElement"></ion-icon>
                </div>
            </div>

            <div class="menu" onclick="toggleMenu()">
                <ion-icon id="menu-icon" name="chevron-back-sharp"></ion-icon>
            </div>


            <div class="tools-c">
                <div class="analyze pt-4    pb-3 gap-2 border-bottom">
                    <span class="light-text"> Track</span>
                    <div class="tools d-flex gap-1 ">
                        <ion-icon name="timer-outline"></ion-icon>
                        <span class="none">TimeSheet</span>
                    </div>

                </div>
                <div class="analyze pt-4  pb-3  gap-2 border-bottom">
                    <span class="light-text"> Analyze</span>
                    <div class="tools  ">
                        <a href="{{ route('dashboard') }}" class="d-flex gap-1">
                            <ion-icon name="speedometer-outline"></ion-icon>
                            <span class="none">Dashboard</span>
                        </a>
                    </div>
                    <div class="tools d-flex gap-1">
                        <ion-icon name="pie-chart-outline"></ion-icon>
                        <span class="none">Dashboard</span>
                    </div>
                </div>
                <div class="analyze pt-4 pb-3 border-bottom">
                    <span class="light-text"> Analyze</span>

                    <div class="tools">
                        <a href="{{ route('tasks') }}" class="d-flex gap-1">
                            <ion-icon name="folder-outline"></ion-icon>
                            <span class="none">Tasks</span>
                        </a>
                    </div>
                    <div class="tools">
                        <a href="{{ route('profile') }}" class="d-flex gap-1">
                            <ion-icon name="person-circle-outline"></ion-icon>
                            <span class="none">Profile</span>
                        </a>
                    </div>
                    <div class="tools">
                        <a href="{{ route('projects') }}" class="d-flex gap-1">
                            <ion-icon name="person-circle-outline"></ion-icon>
                            <span class="none">Project</span>
                        </a>
                    </div>

                    <div class="tools">
                        <a id="openModalBtn1" class="d-flex gap-1">
                            <ion-icon name="log-out-outline"></ion-icon>

                            <span class="none">Logout</span>
                        </a>

                        <div id="modal1" class="modal">
                            <div class="modal-content">
                                <h2>Realy Want to Logout??</h2>
                                <span>

                                    <form action="{{ route('logout') }}" method="POST" class="logout">
                                        @csrf
                                        <button type="submit" name="lg_btn">Logout</button>
                                    </form>

                                    <button id="closeModalBtn1"
                                        style="background-color: rgb(201, 39, 39)">Cancel</button>
                                </span>
                                <!-- Add your settings form or content here -->

                                </span>
                            </div>
                        </div>




                    </div>
                </div>


            </div>


        </div>

        <script>
            var modal1 = document.getElementById("modal1");

            // Get the button that opens the new modal
            var openModalBtn1 = document.getElementById("openModalBtn1");

            // Get the button that closes the new modal
            var closeModalBtn1 = document.getElementById("closeModalBtn1");

            // When the user clicks the button, open the new modal
            openModalBtn1.addEventListener("click", function() {
                modal1.style.display = "block";
            });

            // When the user clicks the close button, close the new modal
            closeModalBtn1.addEventListener("click", function() {
                modal1.style.display = "none";
            });

            // When the user clicks anywhere outside of the new modal, close it
            window.addEventListener("click", function(event) {
                if (event.target === modal1) {
                    modal1.style.display = "none";
                }
            });
        </script>
        <!-- whole -->
