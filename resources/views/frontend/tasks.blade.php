@extends('layouts.main')


@section('content')

    <div class="right-section">

        <div class="top">

            <span>Projects / Tasks</span>
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
            <div id="flash-message" class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div id="notification-container" class="alert alert-success" style="display: none;"></div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        {{-- modal and forms --}}
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


        {{-- layouts --}}

        <style>
            .create {
                width: 30%;
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

            .search-container {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-evenly;
                padding-left: 5rem;

            }

            .search-container form {
                width: 70%;
                display: flex;
                padding-bottom: 1rem;
            }

            .search-container form button:hover {
                background-color: #b2bdd4;
            }

            .search-container form input {
                width: 80%;
                padding: 0.5rem 1rem;
                border: none;
                outline: none;
                box-shadow: 1px 1px 4px rgba(91, 89, 89, 0.872);
                border: none;
            }

            .search-container form button {
                width: 7%;
                border: none;
                padding: 4.6px 10px;
                color: #F6F8E2;
                font-size: 1.28rem;
                background-color: #3C3D42;
                box-shadow: 1px 1px 4px rgb(91, 89, 89);


            }


            .search-container form input:hover {
                box-shadow: 1px 1px 4px rgba(36, 37, 36, 0.422);

            }


            .table {
                padding: 0rem 3rem;
            }
        </style>
        <div id="projectModal" class="modal-container">
            <!-- Modal content -->
            <div class="modal-content1">
                <div class="form-container">

                    <form method="POST" action="{{ route('createProject') }}" class="form">
                        @csrf
                        <p class="form-title">Add a new Project</p>
                        <div class="input-container">
                            <label for="duaDate"> Project name</label>
                            <input type="name" name="projectName" placeholder="Enter Project Name"
                                value="{{ old('projectName') }}">
                        </div>

                        <div class="input-container">
                            <label for="duaDate">Descriptions</label><br>
                            <textarea name="description" value="{{ old('description') }}" id="" placeholder="Enter Details" cols="39"
                                rows="5"></textarea>

                        </div>
                        <button type="submit" class="submit">
                            Create
                        </button>
                    </form>
                    <button onclick="closeModal()" class="close">Cancel</button>
                </div>
            </div>

        </div>

        <div class="search-container">


            <form action="{{ route('tasks') }}" method="GET">
                <input type="text" name="search" value="{{ $search }}" placeholder="Search task">
                <button type="submit"><ion-icon name="search-outline"></ion-icon></button>
            </form>
            {{--   <div class="create">
                <button onclick="openModal()" class="open">Create New Task</button>
            </div> --}}

        </div>

        <hr>
        <div class="table">



            @if ($tasks->isEmpty() && !$search)
                <p>No Task found. Please Create a Project.</p>
            @elseif ($tasks->isEmpty() && $search)
                <p>No tasks found for "{{ $search }}"</p>
            @elseif ($tasks->isNotEmpty())
                <table>
                    <style>
                        table {
                            color: #3C3D42;
                            width: 100%;
                            background: transparent;
                        }

                        th,
                        td {
                            padding: 15px;
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
                            <th>Created At</th>
                            <th>Start</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tasks as $task)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $task->taskname }}</td>

                                {{-- <td>{{ $task->project ? $task->project->projectName : 'No Project' }}</td> --}}
                                <td>{{ $task->created_at->format('Y-m-d') }}</td>

                                <td>
                                    <form class="start-time-form" action="{{ route('start.time', ['id' => $task->id]) }}"
                                        method="POST">
                                        @csrf
                                        <button type="submit" class="start-time-button">Start Time</button>
                                    </form>


                                </td>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>No projects found. Please create a project.</p>
            @endif


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




                /*    $(document).ready(function() {
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

                                   var messageContainer = form.closest('td').find('.message-container');
                                   messageContainer.css('display', 'block');
                                   messageContainer.html(response.message);
                               },
                               error: function(xhr) {
                                   console.error("Error: " + xhr.responseText);
                               }
                           });
                       });
                   }); */


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
    </section>
@endsection
