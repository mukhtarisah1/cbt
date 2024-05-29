<!DOCTYPE html>
<html>
<head>
    <title>Results PDF</title>
</head>
<body>
    <h1>Results for {{ $test->title }} in {{ $course->name }}</h1>
    <table>
        <thead>
            <tr>
                <th>Student Name</th>
                <th>Test Name</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody>
            @foreach($results as $result)
                <tr>
                    <td>{{ $result->student->firstname }} {{ $result->student->lastname }}</td>
                    <td>{{ $result->test->title }}</td>
                    <td>{{ $result->score }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
