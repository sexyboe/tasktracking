    @extends('layouts.main')


    @section('content')
        <div class="right-section">

            <div class="top">

                <span>Projects / View</span>
                <div class="top-right">
                    <a href="{{ route('profile') }}">

                        <ion-icon name="share-social-outline"></ion-icon>
                    </a>
                    <a href="http://">

                        <ion-icon name="person-circle"></ion-icon>
                    </a>
                    <a href="http://">

                        <ion-icon name="help-circle-outline"></ion-icon>
                    </a>
                    <a href="http://">
                        <ion-icon name="person-add-outline"></ion-icon>
                    </a>

                </div>
            </div>
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="tasks">


                <div class="projects">
                    <div class="card">

                        <div class="card_left card-section">

                            <p class="info"> <span>Project :</span>{{ $projects->projectName }}</p>
                            <p class="info"> <span>Due Date :</span>{{ $projects->descriptions }}</p>
                            <p class="info"> <span>Status :</span> {{ $projects->status }}</p>


                        </div>
                        <div class="card_right card-section">


                            <p class="info"> <span>Started At :</span>{{ $projects->created_at->format('Y-m-d') }}
                            </p>
                            <p class="info">
                                <span>Due Date :</span> {{ \Carbon\Carbon::parse($projects->dueDate)->toDateString() }}
                            </p>
                            <p class='info'>
                                <span>Time Remaining :</span><span id="countdown" class="info"></span>
                            </p>
                        </div>

                        <div class="card-section">



                            @php
                                $totalTasks = App\Models\tasks::where('project_id', $projects->id)->count();
                            @endphp
                            <p class="info"> <span>Total Task :</span>{{ $totalTasks }}</p>


                            <button onclick="openModal()">Create new Task</button>

                        </div>
                    </div>

                </div>


                <div id="projectModal" class="modal-container">
                    <!-- Modal content -->
                    <div class="modal-content1">
                        <div class="form-container">

                            <form method="POST" action="{{ route('createTask') }}" class="form">
                                @csrf
                                <p class="form-title">Add Task</p>
                                <div class="input-container">
                                    <label for="taskName"> Task Name</label>
                                    <input type="text" name="taskname" placeholder="Enter your Task"
                                        value="{{ old('taskname') }}">
                                </div>
                                <div class="input-container">
                                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                                    <input type="hidden" name="project_id" value="{{ $projects->id }}">
                                </div>
                                <div class="input-container">
                                    <label for="descriptions">Descriptions</label><br>
                                    <textarea name="description" placeholder="Enter Details" cols="39" rows="5">{{ old('description') }}</textarea>

                                </div>
                                <button type="submit" class="submit">
                                    Create
                                </button>
                            </form>
                            <button onclick="closeModal()" class="close">Cancel</button>
                        </div>
                    </div>

                </div>


                <div class="tasks-list">

                    <table>
                        <style>
                            table {
                                color: #3C3D42;
                                width: 100%;
                                background: transparent;
                            }

                            th,
                            td {
                                padding: 5px;
                            }


                            th {
                                background-color: #3C3D42;
                                color: #F6F8E2;
                            }

                            tr:hover {
                                background-color: #9CCD62;
                            }

                            td {
                                font-size: 1rem;
                                border-bottom: 0.2px solid rgb(0, 0, 0);
                            }
                        </style>
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Task Name</th>
                                <!-- Add other table headers as needed -->
                                <th>Created At</th>
                                <th>Due Date</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects->tasks as $task)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $task->taskname }}</td>
                                    <td>{{ $task->created_at }}</td>
                                    <td>{{ $task->description }}</td>

                                    {{-- 
                                        <td>{{ $project->created_at->format('Y-m-d') }}</td> --}}


                                    {{-- <td><a href="{{ route('vprojects', ['project_id' => $project->id]) }}">View</a> --}}
                                    <!-- Add other table cells for project data -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>

        <style>
            .tasks-list {
                padding-top: 1px;
            }

            .card-section button:hover {
                background-color: #9CCD62;
                box-shadow: 4px 2px 5px rgb(89, 87, 87)
            }


            .card-section button {
                background-color: #F6F8E2;
                box-shadow: 4px 2px 5px rgb(0, 0, 0);
                color: #3C3D42;
                outline: none;
                border: none;
                display: block;
                padding-top: 0.75rem;
                padding-bottom: 0.75rem;
                padding-left: 1.25rem;
                padding-right: 1.25rem;

                font-size: 0.875rem;
                line-height: 1.25rem;
                font-weight: 500;

                border-radius: 0.5rem;

            }


            .tasks {
                width: 100%;
                height: 100%;
                display: flex;
                flex-direction: column;
                padding: 0rem 2rem;
            }

            .projects p {
                float: right;
            }

            .projects p span {
                font-weight: bold;
            }

            /* /card */


            .card {
                width: 100%;
                background: #3C3D42;
                transition: 1s ease-in-out;
                display: flex;
                border-end-start-radius: 0;
                border-end-end-radius: 0;

                flex-direction: row;
                justify-content: space-around;
            }

            .card-section {
                display: flex;
                flex-direction: column;
                justify-content: center;
            }

            .card span {
                font-weight: 700;
                color: #F6F8E2;
                text-align: center;
                display: block;
                font-size: 1rem;
            }

            .card .info {
                font-weight: 600;
                color: white;
                display: block;
                text-align: center;
                font-size: 0.9rem;
                padding: 5px 0;
            }

            .card .times {
                width: 100%;
                display: flex;
                flex-direction: row;
                color: white;
                font-size: 0.7rem;
            }
        </style>

        <!-- Display pagination links -->



        {{-- forms --}}

        <style>
            .container {
                display: flex;
                justify-content: center;
                flex-direction: column;
                align-items: center;

            }

            .form-container {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                row-gap: 1rem;
                width: 100%;
                /* padding: 1rem; */
                padding-top: 70px;
            }

            .form {
                background-color: #fff;
                display: block;
                padding: 1rem;
                max-width: 350px;
                border-radius: 0.5rem;
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
            }

            .form-title {
                font-size: 1.25rem;
                line-height: 1.75rem;
                font-weight: 600;
                text-align: center;
                color: #000;
            }

            .input-container {
                position: relative;
            }



            .input-container input:hover {
                box-shadow: 1px 1px 3px rgba(147, 143, 143, 0.365) inset;
            }

            .input-container input,
            .form button {
                outline: none;
                border: 1px solid #e5e7eb;
                margin: 8px 0;
            }

            .input-container input {
                background-color: #fff;
                padding: 1rem;
                font-size: 0.875rem;
                line-height: 1.25rem;
                width: 300px;
                border-radius: 0.5rem;
                box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            }

            .submit:hover {
                box-shadow: 1px 2px 4px rgba(86, 83, 83, 0.687)
            }

            .submit {
                display: block;
                padding-top: 0.75rem;
                padding-bottom: 0.75rem;
                padding-left: 1.25rem;
                padding-right: 1.25rem;
                background-color: #46e561;
                color: #ffffff;
                font-size: 0.875rem;
                line-height: 1.25rem;
                font-weight: 500;
                width: 100%;
                border: none;
                border-radius: 0.5rem;
                text-transform: uppercase;
            }

            .signup-link {
                color: #6B7280;
                font-size: 0.875rem;
                line-height: 1.25rem;
                text-align: center;
            }

            .signup-link a {
                text-decoration: underline;
            }

            /* Styling for the modal container */
            .modal-container {
                display: none;
                position: fixed;
                z-index: 999;
                left: 0;
                top: 0;
                width: 100%;
                height: 100%;
                background-color: rgba(0, 0, 0, 0.5);
            }

            /* Styling for the modal content */
            .modal-content {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                /* background-color: transparent; */
                padding: 20px;
                display: flex;
                justify-content: center;
                border-radius: 5px;

            }

            .close:hover {
                box-shadow: 1px 2px 4px rgba(86, 83, 83, 0.687)
            }

            .close {
                display: block;
                padding-top: 0.75rem;
                padding-bottom: 0.75rem;
                padding-left: 1.25rem;
                padding-right: 1.25rem;
                background-color: #e54646;
                color: #ffffff;
                font-size: 0.875rem;
                line-height: 1.25rem;
                font-weight: 500;
                width: 20%;
                border: none;
                border-radius: 0.5rem;
                text-transform: uppercase;

            }

            .open {
                display: block;
                padding-top: 0.75rem;
                transition: 0.3s cubic-bezier(0.23, 1, 0.320, 1);
                padding-bottom: 0.75rem;
                padding-left: 1.25rem;
                padding-right: 1.25rem;
                /* background-color: #46e561; */
                background-color: #3C3D42;
                color: #F6F8E2;
                font-size: 0.875rem;
                line-height: 1.25rem;
                font-weight: 500;
                box-shadow: 1px 1px 4px rgba(70, 69, 69, 0.548);
                border: none;
                border-radius: 0.5rem;
                text-transform: uppercase;
            }

            /* form */
        </style>

        {{-- forms --}}



        </section>
        <script>
            function openModal() {
                var modal = document.getElementById('projectModal');
                modal.style.display = 'block';
            }

            function closeModal() {
                var modal = document.getElementById('projectModal');
                modal.style.display = 'none';
            }


            function updateCountdown(targetDate) {
                var now = new Date().getTime();
                var target = new Date(targetDate).getTime();
                var timeRemaining = target - now;

                var days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
                var hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                var minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
                var seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);

                document.getElementById("countdown").innerHTML = days + " days, " + hours + " hours, " + minutes +
                    " minutes, " + seconds + " seconds";

                if (timeRemaining <= 0) {
                    document.getElementById("countdown").innerHTML = "Expired";
                }
            }

            function startCountdown() {
                // Replace 'YYYY-MM-DD HH:mm:ss' with your actual target date and time
                // For example: updateCountdown('2023-08-31 23:59:59');
                var targetDate = '{{ $projects->dueDate }}';

                // Update the countdown immediately
                updateCountdown(targetDate);

                // Update the countdown every second
                setInterval(function() {
                    updateCountdown(targetDate);
                }, 1000);
            }

            // Start the countdown when the page loads
            startCountdown();
        </script>
    @endsection
