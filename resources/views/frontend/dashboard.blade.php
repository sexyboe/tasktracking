    @extends('layouts.main')

    @section('content')
        <div class="right-section">
            <div class="top">

                <span>Time Sheet</span>
                <div class="top-right">
                    <a href="http://">

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
                <div id="flash-message" class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div id="notification-container" class="alert alert-success" style="display: none;"></div>

            @if ($errors->any())
                <div class="alert alert-danger" id="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div id="projectModal" class="modal-container">
                <!-- Modal content -->
                <div class="modal-content1">
                    <div class="form-container">
                        @if (count($projects) > 0)
                            <form method="POST" action="{{ route('createTask1') }}" class="form">
                                @csrf
                                <p class="form-title">Add Task</p>
                                <div class="input-container">
                                    <label for="taskName"> Task Name</label>
                                    <input type="text" name="taskname" placeholder="Enter your Task"
                                        value="{{ old('taskname') }}">
                                </div>
                                <div class="input-container">
                                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                                </div>
                                <label for="specificProjectSelect" class="form-label">Select Project</label>
                                <select class="form-select" id="specificProjectSelect" name="project_id">
                                    @if (count($projects) === 0)
                                        <option value="0">No project</option>
                                    @else
                                        @foreach ($projects as $project)
                                            <option value="{{ $project->id }}">{{ $project->projectName }}</option>
                                        @endforeach
                                    @endif
                                    <!-- Add more options as needed -->
                                </select>
                                <div class="input-container">
                                    <label for="descriptions">Descriptions</label><br>
                                    <textarea name="description" placeholder="Enter Details" cols="39" rows="2">{{ old('description') }}</textarea>

                                </div>
                                <button type="submit" class="submit">
                                    Create
                                </button>
                            </form>
                        @else
                            <form method="POST" action="{{ route('createProject') }}" class="form">
                                @csrf
                                <p class="form-title">Add a new Project</p>
                                <div class="input-container">
                                    <label for="duaDate"> Project name</label>
                                    <input type="text" name="projectName" placeholder="Enter Project Name">
                                </div>
                                <div class="input-container">
                                    <label for="duaDate">Due Date</label>
                                    <input type="date" name="dueDate" placeholder="Enter due date">
                                    <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                                </div>
                                <div class="input-container">
                                    <label for="duaDate">Descriptions</label><br>
                                    <textarea name="descriptions" id="" placeholder="Enter Details" cols="39" rows="5"></textarea>

                                </div>
                                <button type="submit" class="submit">
                                    Create
                                </button>
                            </form>
                        @endif

                        <button onclick="closeModal()" class="close">Cancel</button>
                    </div>
                </div>

            </div>

            <div class="weeks">

                <div class="">
                    <div class="create">
                        <button onclick="openModal()" class="open">Create New Project</button>
                    </div>
                </div>
                <style>
                    .weeks {
                        display: block;
                        padding: 1rem
                    }

                    .open:hover {
                        box-shadow: 2px 2px 6px rgba(70, 69, 69, 0.774);
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

                    .modal-container {
                        display: none;
                    }

                    {{-- modal and forms --}} .container {
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
                        padding: 1rem;
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


                    /* form */
                </style>
                <hr>
                <div class="table">



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
                                font-family: ;
                            }
                        </style>
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Task Name</th>
                                <!-- Add other table headers as needed -->
                                <th>Project Name</th>
                                <th>Time Period</th>
                                <th>Started at</th>
                                <th>End At</th>
                                <th>Start Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $task->taskname }}</td>

                                    <td>{{ $task->projects->projectName }}</td>
                                    <td id="taskDurationCell">
                                        @if ($task->start_time && $task->end_time)
                                            {{ \Carbon\CarbonInterval::seconds(
                                                \Carbon\Carbon::parse($task->start_time)->diffInSeconds(\Carbon\Carbon::parse($task->end_time)),
                                            )->cascade()->forHumans() }}
                                        @else
                                            N/A
                                        @endif
                                    </td>

                                

           





                                    <td>{{ $task->start_time }}</td>
                                    <td>{{ $task->end_time ? $task->end_time : 'null' }}</td>

                                    <td>

                                        <form class="start-time-form"
                                            action="{{ route('start.time', ['id' => $task->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="start-time-button"
                                                id="startButton-{{ $task->id }}">Start Time</button>
                                        </form>


                                    </td>
                                    <td>
                                        <form class="start-time-form"
                                            action="{{ route('stop.time', ['id' => $task->id]) }}" method="POST">
                                            @csrf
                                            <button id="stopButton-{{ $task->id }}" type="submit"
                                                class="action-button" style="display: none;">Stop</button>
                                        </form>

                                        <style>
                                            .start-time-button {
                                                margin-right: 10px;
                                                background-color: rgb(75, 176, 99);
                                                color: white;
                                                padding: 8px 19px;
                                                display: flex;
                                                align-items: center;
                                                border-radius: 10px;
                                                border: none;
                                                gap: 10px;
                                                transition: all 0.2s;
                                            }

                                            .action-button {
                                                margin-right: 10px;
                                                background-color: rgb(176, 75, 90);
                                                color: white;
                                                padding: 8px 19px;
                                                display: flex;
                                                align-items: center;
                                                border-radius: 10px;
                                                border: none;
                                                gap: 10px;
                                                transition: all 0.2s;
                                            }
                                        </style>
                                    </td>
                            @endforeach
                        </tbody>
                    </table>





                    <script>
                        // JavaScript functions to handle the modal
                        function openModal() {
                            var modal = document.getElementById('projectModal');
                            modal.style.display = 'block';
                        }

                        function closeModal() {
                            var modal = document.getElementById('projectModal');
                            modal.style.display = 'none';
                        }


                        setTimeout(function() {
                            document.getElementById('flash-message').style.display = 'none';
                        }, 3000); // 5000 milliseconds = 5 seconds
                        //

                        document.addEventListener('DOMContentLoaded', function() {
                            var startButtons = document.querySelectorAll('.start-time-button');
                            var stopButtons = document.querySelectorAll('.action-button');

                            startButtons.forEach(function(startButton) {
                                var taskId = startButton.getAttribute('id').split('-')[1];
                                var stopButton = document.getElementById('stopButton-' + taskId);

                                // Retrieve the task started state from localStorage
                                var isTaskStarted = localStorage.getItem('taskStarted-' + taskId);

                                // Update button visibility based on the retrieved state
                                if (isTaskStarted === 'true') {
                                    startButton.style.display = 'none';
                                    stopButton.style.display = 'block';
                                } else {
                                    startButton.style.display = 'block';
                                    stopButton.style.display = 'none';
                                }

                                startButton.addEventListener('click', function() {
                                    // Update localStorage to indicate task is started
                                    localStorage.setItem('taskStarted-' + taskId, 'true');

                                    // Update button visibility
                                    startButton.style.display = 'none';
                                    stopButton.style.display = 'block';
                                });

                                stopButton.addEventListener('click', function() {
                                    // Update localStorage to indicate task is stopped
                                    localStorage.setItem('taskStarted-' + taskId, 'false');

                                    // Update button visibility
                                    stopButton.style.display = 'none';
                                    startButton.style.display = 'block';
                                });
                            });
                        });

                        //
                        $(document).ready(function() {
                            $(".start-time-form").submit(function(event) {
                                event.preventDefault();

                                var form = $(this);

                                $.ajax({
                                    url: form.attr("action"),
                                    type: "POST",
                                    data: form.serialize(),
                                    dataType: "json", // Ensure this is set to JSON
                                    success: function(response) {
                                        console.log(response.message);

                                        var notificationContainer = $('#notification-container');
                                        notificationContainer.html(response.message).slideDown();

                                        // Hide the notification after a delay (e.g., 5 seconds)
                                        setTimeout(function() {
                                            notificationContainer.slideUp();
                                        }, 3000);
                                    },
                                    error: function(xhr) {
                                        console.error("Error: " + xhr.responseText);
                                    }
                                });
                            });
                        });
                    </script>

                </div>


            </div>

            <script>
                function openModal() {
                    var modal = document.getElementById('projectModal');
                    modal.style.display = 'block';
                }

                function closeModal() {
                    var modal = document.getElementById('projectModal');
                    modal.style.display = 'none';
                }
                // Automatically hide the flash message after 5 seconds (adjust as needed)
                setTimeout(function() {
                    document.getElementById('flash-message').style.display = 'none';
                }, 3000); // 5000 milliseconds = 5 seconds
            </script>
        @endsection
