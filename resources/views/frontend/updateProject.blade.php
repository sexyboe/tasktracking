    @extends('layouts.main')


    @section('content')
        <div class="right-section">

            <div class="top">

                <span>Projects</span>
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

                    <p class="form-title">Add Task</p>
                    <div class="input-container">
                        <label for="projectName"> Task Name</label>
                        <input type="text" name="projectName" placeholder="Enter your Project"
                            value="{{ old('projectName', $projects->projectName) }}">
                    </div>
                    <div class="input-container">
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">
                        <input type="hidden" name="project_id" value="{{ $projects->id }}">
                    </div>
                    <div class="input-container">
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




        </div>




        </section>

    @endsection
