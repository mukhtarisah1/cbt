@extends('layouts.layout')
@section('content')
    <div class="container">
        <h2>Assign Test</h2>
        
        <form action="{{ route('courses.tests.assign.store', ['course' => $course->id, 'test' => $test->id] ) }}" method="post">
            @csrf

            <div class="col-md-6">
                <!-- .form-group -->
                <div class="form-group">
                    <label for="levels">Levels</label>
                    
                    <select class="custom-select" id="sel1" required="">
                        <option value=""> Choose... </option>
                        @forelse($levels as $level)
                            <option value="{{ $level->level }}">{{ $level->level }}</option>
                        @empty
                            <option>No level created yet</option>
                        @endforelse
                    </select>
                </div><!-- /.form-group -->

                <!-- .form-group -->
                <div class="form-group">
                    <label for="students">Students</label>
                    
                    <div id="students-container">
                        <!-- Students checkboxes will be dynamically added here using JavaScript -->
                    </div>
                </div><!-- /.form-group -->

            </div>
            <button type="submit" class="btn btn-primary">Assign Test</button>
        </form>

        <script>
                document.getElementById('sel1').addEventListener('change', function() {
                var levelId = this.value;

                // Make an AJAX request to get students for the selected level
                fetch(`/get-students/${levelId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error(`HTTP error! Status: ${response.status}`);
                        }
                        return response.json();
                    })
                    .then(data => {
                        var studentsContainer = document.getElementById('students-container');
                        studentsContainer.innerHTML = ''; // Clear existing checkboxes

                        if (data.length > 0) {
                            data.forEach(student => {
                                // Add a checkbox for each student
                                var checkbox = document.createElement('input');
                                checkbox.type = 'checkbox';
                                checkbox.name = 'students[]';
                                checkbox.value = student.reg_no;

                                // Label for the checkbox
                                var label = document.createElement('label');
                                label.htmlFor = `student_${student.id}`;
                                label.appendChild(checkbox);
                                label.appendChild(document.createTextNode(student.reg_no));

                                // Append the checkbox and label to the container
                                studentsContainer.appendChild(label);
                                studentsContainer.appendChild(document.createElement('br')); // Add line break for better spacing
                            });
                        } else {
                            // If no students found, add a message
                            var message = document.createElement('p');
                            message.innerText = 'No students for this level';
                            studentsContainer.appendChild(message);
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching students', error);
                    });
            });
        </script>

    </div>
@endsection
