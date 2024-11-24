@extends('layouts.layout')

@section('content')

   
        

            <!-- Header Section -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h5 class="card-title text-success">Manage Questions for {{ $test->title }} test</h5>
                <a href="{{ route('courses.tests.show', [$course, $test]) }}" class="btn btn-secondary">
                    Back to Test
                </a>
            </div>
            
            <!-- Import Questions Section -->
            <h6>Import Questions</h6>
            <form action="{{ route('courses.tests.questions.import', [$course, $test]) }}" method="POST" enctype="multipart/form-data" class="mb-4">
                @csrf
                <div class="form-group">
                    <label for="questions_file">Upload Excel File:</label>
                    <input type="file" class="form-control" name="questions_file" id="questions_file" accept=".xlsx,.csv" required>
                </div>
                <button type="submit" class="btn btn-primary">Import Questions</button>
            </form>

            <hr>

            <!-- Add Individual Question Section -->
            <h6>Add Individual Question</h6>
            <form action="{{ route('courses.tests.questions.store', [$course, $test]) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="question">Question:</label>
                    <textarea class="form-control" id="editor" style="height: 200px;" name="question" required>{{ old('question') }}</textarea>
                </div>
                <div class="form-group">
                    <label for="option_a">Option A:</label>
                    <input type="text" class="form-control" name="option_a" value="{{ old('option_a') }}" required>
                </div>
                <div class="form-group">
                    <label for="option_b">Option B:</label>
                    <input type="text" class="form-control" name="option_b" value="{{ old('option_b') }}" required>
                </div>
                <div class="form-group">
                    <label for="option_c">Option C:</label>
                    <input type="text" class="form-control" name="option_c" value="{{ old('option_c') }}" required>
                </div>
                <div class="form-group">
                    <label for="option_d">Option D:</label>
                    <input type="text" class="form-control" name="option_d" value="{{ old('option_d') }}" required>
                </div>
                <div class="form-group">
                    <label for="correct_answer">Correct Answer:</label>
                    <input type="text" class="form-control" name="correct_answer" value="{{ old('correct_answer') }}" required>
                </div>
                <button type="submit" class="btn btn-success">Add Question</button>
            </form>
        </div>
    </div>

    <script>
        var quill = new Quill('#editor', {
            theme: 'snow',
            modules: {
                toolbar: [
                    ['bold', 'italic', 'underline', 'strike'],        // toggled buttons
                    ['blockquote', 'code-block'],
                    ['image'],                                       // image button

                    [{ 'header': 1 }, { 'header': 2 }],               // custom button values
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'script': 'sub'}, { 'script': 'super' }],      // superscript/subscript
                    [{ 'indent': '-1'}, { 'indent': '+1' }],          // outdent/indent
                    [{ 'direction': 'rtl' }],                         // text direction

                    [{ 'size': ['small', false, 'large', 'huge'] }],  // custom dropdown
                    [{ 'header': [1, 2, 3, 4, 5, 6, false] }],

                    [{ 'color': [] }, { 'background': [] }],          // dropdown with defaults from theme
                    [{ 'font': [] }],
                    [{ 'align': [] }],

                    ['clean']                                         // remove formatting button
                ],
                imageDropAndPaste: {
                    handler: function (imageData) {
                        // Handle the dropped or pasted image data here
                        // You may want to upload the image to your server and insert the image URL into the editor
                        // Example: quill.clipboard.dangerouslyPasteHTML('<img src="' + imageUrl + '">');
                    }
                }
            }
        });

        // Listen for the 'text-change' event to update the hidden input
        quill.on('text-change', function() {
            var editor = document.getElementById('editor');
            editor.value = quill.root.innerHTML;
            console.log(editor.value)
        });
    </script>

@endsection
