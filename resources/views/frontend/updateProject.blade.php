    @extends('layouts.main')


    @section('content')
        <div class="right-section">

            <div class="top">

                <span>Projects / Update</span>
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


            <div class="form-container">

                <form method="POST" action="{{ route('updateProjects', ['id' => $projects->id]) }}" class="form">
                    @csrf
                    @method('PUT') <!-- Add this line to spoof the PUT request -->

                    <p class="form-title">Update</p>

                    <label for="projectName"> Task Name : </label>
                    <input type="text" name="projectName" placeholder="Enter your Project"
                        value="{{ old('projectName', $projects->projectName) }}">

                    <div class="input-container">
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        <input type="hidden" name="project_id" value="{{ $projects->id }}">
                    </div>
                    <div class="input-container">
                        <label for="projectName"> Due Date :</label>

                        <input type="date" name="dueDate" value="{{ old('dueDate', $projects->dueDate) }}">

                    </div>
                    <div class="input-container">
                        <label for="descriptions">Descriptions</label><br>
                        <textarea name="descriptions" placeholder="Enter Details" cols="39" rows="5">{{ old('descriptions', $projects->descriptions) }}
                </textarea>

                    </div>
                    <button type="submit" class="submit">
                        Create
                    </button>
                </form>

            </div>

            <style>
                .form-container {
                    /* background-color: rgb(138, 161, 161); */
                    padding: 2rem;
                }

                input {
                    padding: 0.6rem 0.3rem;
                    border-radius: 10px;
                }

                textarea {
                    padding: 0.5rem 0.3rem;

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
                    background-color: #b8adad;
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
            </style>


        </div>




        </section>

    @endsection
